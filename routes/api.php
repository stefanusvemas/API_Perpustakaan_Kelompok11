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


Route::middleware(['auth:petugas'])->group(function () {
    Route::get('/penerbit', [\App\Http\Controllers\Api\PenerbitController::class, 'index']);
});

Route::middleware(['auth:api'])->group(function () {
});
