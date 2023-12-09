<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    public function index()
    {
        $penerbit = Penerbit::all();

        return response([
            'message' => 'All Penerbit Retrieved',
            'data' => $penerbit
        ], 200);
    }
}
