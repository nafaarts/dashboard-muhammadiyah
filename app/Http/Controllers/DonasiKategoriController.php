<?php

namespace App\Http\Controllers;

use App\Models\DonasiKategori;

class DonasiKategoriController extends Controller
{
    public function index()
    {
        $kategori = DonasiKategori::latest()->get();
        return response([
            'success' => true,
            'message' => 'Donation Category list',
            'count' => $kategori->count(),
            'data'   => $kategori
        ], 200);
    }
}
