<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();

        return response([
            'message' => 'All Kategori Retrieved',
            'data' => $kategori
        ], 200);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama' => 'required|unique:kategori',
            'warna' => 'required'
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        $kategori = Kategori::create($request->all());

        return response([
            'message' => 'Kategori Added',
            'data' => $kategori
        ], 200);
    }
}
