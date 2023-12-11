<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengarang;
use Illuminate\Support\Facades\Validator;

class PengarangController extends Controller
{
    public function index()
    {
        $pengarang = Pengarang::all();

        return response([
            'message' => 'All Penerbit Retrieved',
            'data' => $pengarang
        ], 200);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama' => 'required|unique:pengarang'
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        $pengarang = Pengarang::create($request->all());

        return response([
            'message' => 'Penerbit Added',
            'data' => $pengarang
        ], 200);
    }
}
