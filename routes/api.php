<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/petugas/login', [\App\Http\Controllers\Api\AuthController::class, 'loginAdmin']);
Route::post('/petugas/register', [\App\Http\Controllers\Api\AuthController::class, 'registerAdmin']);
Route::get('/buku', [\App\Http\Controllers\Api\BukuController::class, 'index']);


Route::middleware(['auth:petugas'])->group(function () {
    Route::get('/penerbit', [\App\Http\Controllers\Api\PenerbitController::class, 'index']);
    Route::post('/penerbit', [\App\Http\Controllers\Api\PenerbitController::class, 'store']);

    Route::get('/kategori', [\App\Http\Controllers\Api\KategoriController::class, 'index']);
    Route::post('/kategori', [\App\Http\Controllers\Api\KategoriController::class, 'store']);

    Route::get('/pengarang', [\App\Http\Controllers\Api\PengarangController::class, 'index']);
    Route::post('/pengarang', [\App\Http\Controllers\Api\PengarangController::class, 'store']);

    Route::post('/buku', [\App\Http\Controllers\Api\BukuController::class, 'store']);
    Route::get('/buku/{id}', [\App\Http\Controllers\Api\BukuController::class, 'search']);
    Route::post('/buku/{id}', [\App\Http\Controllers\Api\BukuController::class, 'update']);
    Route::delete('/buku/{id}', [\App\Http\Controllers\Api\BukuController::class, 'destroy']);

    // Route::get('/anggota', [\App\Http\Controllers\Api\AnggotaController::class, 'index']);
    // Route::post('/anggota', [\App\Http\Controllers\Api\AnggotaController::class, 'store']);
    // Route::get('/anggota/{id}', [\App\Http\Controllers\Api\AnggotaController::class, 'show']);
    // Route::put('/anggota/{id}', [\App\Http\Controllers\Api\AnggotaController::class, 'update']);
    // Route::delete('/anggota/{id}', [\App\Http\Controllers\Api\AnggotaController::class, 'destroy']);

    // Route::get('/peminjaman', [\App\Http\Controllers\Api\PeminjamanController::class, 'index']);
    // Route::post('/peminjaman', [\App\Http\Controllers\Api\PeminjamanController::class, 'store']);
    // Route::get('/peminjaman/{id}', [\App\Http\Controllers\Api\PeminjamanController::class, 'show']);
    // Route::put('/peminjaman/{id}', [\App\Http\Controllers\Api\PeminjamanController::class, 'update']);
    // Route::delete('/peminjaman/{id}', [\App\Http\Controllers\Api\PeminjamanController::class, 'destroy']);

    // Route::get('/peminjaman-detail/{id}', [\App\Http\Controllers\Api\PeminjamanDetailController::class, 'index']);
    // Route::post('/peminjaman-detail', [\App\Http\Controllers\Api\PeminjamanDetailController::class, 'store']);

    // Route::get('/buku/{id}/review', [\App\Http\Controllers\Api\BukuController::class, 'showReview']);

    // Route::get('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
});

Route::middleware(['auth:api'])->group(function () {
    // Route::get('/anggota/{id}', [\App\Http\Controllers\Api\AnggotaController::class, 'show']);
    // Route::put('/anggota/{id}', [\App\Http\Controllers\Api\AnggotaController::class, 'update']);

    // Route::get('/buku', [\App\Http\Controllers\Api\BukuController::class, 'index']);
    // Route::get('/buku/{id}', [\App\Http\Controllers\Api\BukuController::class, 'show']);

    // Route::get('/buku/{id}/review', [\App\Http\Controllers\Api\BukuController::class, 'showReview']);
    // Route::post('/buku/{id}/review', [\App\Http\Controllers\Api\BukuController::class, 'storeReview']);
    // Route::put('/buku/{id}/review/{id_review}', [\App\Http\Controllers\Api\BukuController::class, 'updateReview']);
    // Route::delete('/buku/{id}/review/{id_review}', [\App\Http\Controllers\Api\BukuController::class, 'destroyReview']);

    // Route::get('/peminjaman-detail/{id}', [\App\Http\Controllers\Api\PeminjamanDetailController::class, 'show']);

    // Route::get('/tagihan/{id}', [\App\Http\Controllers\Api\TagihanController::class, 'show']);

    // Route::post('/transaksi', [\App\Http\Controllers\Api\TransaksiController::class, 'store']);
    // Route::get('transaksi/{id}', [\App\Http\Controllers\Api\TransaksiController::class, 'index']);

    Route::get('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
});
