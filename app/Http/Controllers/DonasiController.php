<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\DonasiKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DonasiController extends Controller
{
    public function index()
    {
        $donasi = Donasi::latest()->get();
        $data = collect($donasi)->map(function ($item, $key) {
            return collect($item)->merge([
                'kategori' => DonasiKategori::findOrFail($item->kategori),
                'gambar' => asset('img/donasi/' . $item->gambar),
                'created_at' => Carbon::parse($item->created_at)->diffForHumans()
            ]);
        });
        return response([
            'success' => true,
            'message' => 'Donation list',
            'count' => $donasi->count(),
            'data'   => $data
        ], 200);
    }

    public function show($slug)
    {
        $donasi = Donasi::where('slug', $slug)->get()->first();
        $data = collect($donasi)->merge([
            'kategori' => DonasiKategori::findOrFail($donasi->kategori),
            'gambar' => asset('img/donasi/' . $donasi->gambar),
            'created_at' => Carbon::parse($donasi->created_at)->diffForHumans()
        ]);
        return response([
            'success' => true,
            'message' => 'Show Donation',
            'data'   => $data->all()
        ], 200);
    }
}
