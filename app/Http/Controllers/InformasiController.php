<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use App\Models\Kategori;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    public function index(Request $request)
    {
        $informasi = Informasi::latest()->get();

        if ($request->get('page')) {
            $informasi = Informasi::latest()->paginate(($request->get('limit')) ? $request->get('limit') : 6)->items();
        }

        $data = collect($informasi)->map(function ($item) {
            return collect($item)->merge([
                'gambar' => [
                    'original' => asset('img/informasi/' . $item->gambar),
                    'medium' => asset('img/informasi/medium/' . $item->gambar),
                    'thumbnail' => asset('img/informasi/thumbnail/' . $item->gambar)
                ],
                'kategori' => Kategori::findOrFail($item->kategori)
            ]);
        });

        return response([
            'success' => true,
            'message' => 'Information list',
            'data'   => $data
        ], 200);
    }

    public function show($slug)
    {
        $informasi = Informasi::where('slug', $slug)->get()->first();
        if ($informasi == null) {
            return response('Bad Request', 400);
        }
        $informasi->update([
            'views' => $informasi->views + 1
        ]);
        $data = collect($informasi)->merge([
            'gambar' => [
                'original' => asset('img/informasi/' . $informasi->gambar),
                'medium' => asset('img/informasi/medium/' . $informasi->gambar),
                'thumbnail' => asset('img/informasi/thumbnail/' . $informasi->gambar)
            ],
            'kategori' => Kategori::findOrFail($informasi->kategori),
            'created_at' => $informasi->created_at->diffForHumans()
        ]);

        $data['latest'] = collect(Informasi::where('slug', '!=', $slug)->limit(3)->get())->map(function ($item) {
            return collect($item)->merge([
                'gambar' => [
                    'original' => asset('img/informasi/' . $item->gambar),
                    'medium' => asset('img/informasi/medium/' . $item->gambar),
                    'thumbnail' => asset('img/informasi/thumbnail/' . $item->gambar)
                ],
                'kategori' => Kategori::findOrFail($item->kategori),
                'created_at' => $item->created_at->diffForHumans()

            ]);
        });
        return response([
            'success' => true,
            'message' => 'Show Informasi',
            'data'   => $data
        ], 200);
    }
}
