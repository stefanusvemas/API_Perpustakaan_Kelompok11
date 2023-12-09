<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Petugas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Mail\MailSend;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Laravel\Passport\HasApiTokens;

class AuthController extends Controller
{
    use HasApiTokens;
    public function register(Request $request)
    {
        $registrationData = $request->all();

        $validate = validator::make($registrationData, [
            'nama' => 'required|max:60',
            'email' => 'required|email:rfc,dns|unique:users',
            'no_telp' => 'required|regex:/^08[0-9]{9,11}$/',
            'foto' => 'required|mimes:jpg,jpeg,png|max:2048',
            'password' => 'required|min:8',
            'alamat' => 'required|max:255'
        ]);
        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }
        $registrationData['password'] = bcrypt($request->password);
        $str = Str::random(100);
        $registrationData['verify_key'] = $str;

        $details = [
            'nama' => $registrationData['nama'],
            'website' => 'Libraria',
            'datetime' => date('Y-m-d H:i:s'),
            'url' => request()->getHttpHost() . '/register/verify/' . $str
        ];
        Mail::to($request->email)->send(new MailSend($details));
        $user = User::create($registrationData);

        return response([
            'message' => 'Register Success',
            'user' => $user
        ], 200);
    }

    public function login(Request $request)
    {
        $loginData = $request->all();

        $validate = Validator::make($loginData, [
            'email' => 'required|email:rfc,dns',
            'password' => 'required'
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        if (!Auth::attempt($loginData)) {
            return response(['message' => 'Invalid Credential'], 401);
        }

        if (!Auth::user()->active) {
            return response(['message' => 'Unverified account, please check your email.'], 401);
        }

        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $token = $user->createToken('Authentication Token')->accessToken;

        return response([
            'message' => 'Authenticated',
            'user' => $user,
            'token_type' => 'Bearer',
            'access_token' => $token
        ]);
    }

    public function verify($verify_key)
    {
        $keyCheck = User::select('verify_key')
            ->where('verify_key', $verify_key)
            ->exists();

        if ($keyCheck) {
            $user = User::where('verify_key', $verify_key)
                ->update([
                    'active' => 1,
                ]);

            return "Verifikasi Berhasil. Akun anda sudah aktif";
        } else {
            return "Keys Tidak Valid.";
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response([
            'message' => 'Logged out'
        ]);
    }

    public function loginAdmin(Request $request)
    {
        $loginData = $request->all();

        $validate = Validator::make($loginData, [
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        $petugas = \App\Models\Petugas::where('email', $loginData['email'])->first();

        if (!$petugas || !password_verify($loginData['password'], $petugas->password)) {
            return response(['message' => 'Invalid Petugas Credential'], 401);
        }
        $token = $petugas->createToken('Petugas Token')->accessToken;

        return response([
            'message' => 'Authenticated',
            'petugas' => $petugas,
            'token_type' => 'Bearer',
            'access_token' => $token,
        ]);
    }

    public function registerAdmin(Request $request)
    {
        $registrationData = $request->all();

        $validate = validator::make($registrationData, [
            'nama' => 'required|max:60',
            'email' => 'required|email:rfc,dns|unique:petugas',
            'no_telp' => 'required|regex:/^08[0-9]{9,11}$/',
            'foto' => 'required|mimes:jpg,jpeg,png|max:2048',
            'password' => 'required|min:8',
            'alamat' => 'required|max:255',
            'jabatan' => 'required'
        ]);
        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }
        $registrationData['password'] = bcrypt($request->password);
        $user = Petugas::create($registrationData);
        return response([
            'message' => 'Register Success',
            'user' => $user
        ], 200);
    }
}
