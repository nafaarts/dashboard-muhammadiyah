<?php

namespace App\Http\Controllers;

use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $gallery = Gallery::latest()->get();
        $data = collect($gallery)->map(function ($item) {
            return collect($item)->merge(['gambar' => [
                'original' => asset('img/gallery/' . $item->gambar),
                'medium' => asset('img/gallery/medium/' . $item->gambar),
                'thumbnail' => asset('img/gallery/thumbnail.' . $item->gambar)
            ]]);
        });

        return response([
            'success' => true,
            'message' => 'Gallery list',
            'count' => $gallery->count(),
            'data'   => $data
        ], 200);
    }

    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);
        return response([
            'success' => true,
            'message' => 'Show Gallery',
            'data'   => $gallery
        ], 200);
    }
}
