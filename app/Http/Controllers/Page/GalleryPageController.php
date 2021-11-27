<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GalleryPageController extends Controller
{
    public function index()
    {
        $title = 'Gallery';
        $data = Gallery::latest()->get();
        return view('gallery', ['title' => $title, 'data' => $data]);
    }

    public function create()
    {
        $title = "Gallery - Add";
        return view('gallery-create', ['title' => $title]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'deskripsi' => 'required',
            'gambar' => 'required|max:10240|mimes:jpg,png,jpeg|image'
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar')->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $name = Str::slug($filename) . '-' . time() . '.' . $extension;
            $path = 'img/gallery/';
            $request->file('gambar')->move($path, $name);
            resizeImage($path . $name, 150, $path . 'thumbnail/' . $name);
            resizeImage($path . $name, 400, $path . 'medium/' . $name);
        }

        Gallery::create([
            'deskripsi' => $request->deskripsi,
            'gambar' => $name,
        ]);

        return redirect('galeri')->with('status', 'Photo successfully added!');
    }

    public function destroy(Gallery $gallery)
    {
        File::delete('img/gallery/' . $gallery->gambar);
        File::delete('img/gallery/thumbnail/' . $gallery->gambar);
        File::delete('img/gallery/medium/' . $gallery->gambar);

        $gallery->delete();

        return redirect('galeri')->with('status', 'Photo successfully deleted!');
    }
}
