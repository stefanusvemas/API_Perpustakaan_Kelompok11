<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::all()->load('pengarang', 'kategori', 'penerbit');

        return response([
            'message' => 'All Buku Retrieved',
            'data' => $buku
        ], 200);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'judul' => 'required|unique:buku',
            'id_pengarang' => 'required',
            'id_kategori' => 'required',
            'id_penerbit' => 'required',
            'stok' => 'required|numeric',
            'cover_buku' => 'required|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        $coverBuku = $request->file('cover_buku');
        $coverBukuName = time() . '_' . $coverBuku->getClientOriginalName();
        $coverBuku->move(public_path('images'), $coverBukuName);

        $bukuData = $request->all();
        $bukuData['cover_buku'] = 'images/' . $coverBukuName;

        $buku = Buku::create($bukuData);

        return response([
            'message' => 'Buku Added',
            'data' => $buku
        ], 200);
    }

    public function search($id)
    {
        $buku = Buku::find($id)->load('pengarang', 'kategori', 'penerbit');

        return response([
            'message' => 'Hasil Pencarian',
            'data' => $buku
        ], 200);
    }

    public function update($id, request $request)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            return response([
                'message' => 'Buku Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();

        $validate = Validator::make($request->all(), [
            'judul' => 'required|unique:buku',
            'id_pengarang' => 'required',
            'id_kategori' => 'required',
            'id_penerbit' => 'required',
            'stok' => 'required|numeric',
            'cover_buku' => 'required|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if ($validate->fails()) {
            return response(['message' => $validate->errors()], 400);
        }

        if ($request->hasFile('cover_buku')) {
            $coverBuku = $request->file('cover_buku');
            $coverBukuName = time() . '_' . $coverBuku->getClientOriginalName();
            $coverBuku->move(public_path('images'), $coverBukuName);

            Storage::disk('public')->delete('images/' . $buku->cover_buku);

            $updateData['cover_buku'] = 'images/' . $coverBukuName;
        }

        $buku->update($updateData);

        return response([
            'message' => 'Buku Updated',
            'data' => $buku
        ], 200);
    }

    public function destroy($id)
    {
        $buku = Buku::find($id);
        $buku->delete();

        return response([
            'message' => 'Buku Deleted',
        ], 200);
    }
}
