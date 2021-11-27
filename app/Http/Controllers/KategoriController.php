<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::latest()->get();
        return response([
            'success' => true,
            'message' => 'Information Category list',
            'count' => $kategori->count(),
            'data'   => $kategori
        ], 200);
    }
}
