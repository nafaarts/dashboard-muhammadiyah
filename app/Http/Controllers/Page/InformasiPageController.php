<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class InformasiPageController extends Controller
{
    public function index()
    {
        $title = "Informasi";
        $data = Informasi::latest()->paginate(6);
        return view('informasi', ['data' => $data, 'title' => $title]);
    }

    public function create()
    {
        $title = "Informasi - Add";
        $kategoris = Kategori::get();
        return view('informasi-create', ['title' => $title, 'kategoris' => $kategoris]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|unique:informasi',
            'deskripsi' => 'required',
            'isi' => 'required',
            'kategori' => 'required',
            'gambar' => 'required|max:5048|mimes:jpg,png,jpeg|image'
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar')->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $name = Str::slug($filename) . '-' . time() . '.' . $extension;
            $path = 'img/informasi/';
            $request->file('gambar')->move($path, $name);
            resizeImage($path . $name, 150, $path . 'thumbnail/' . $name);
            resizeImage($path . $name, 400, $path . 'medium/' . $name);
        }

        Informasi::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'deskripsi' => $request->deskripsi,
            'isi' => $request->isi,
            'kategori' => $request->kategori,
            'gambar' => $name,
            'views' => 0,
        ]);

        return redirect('informasi')->with('status', 'Informasi successfully added!');
    }

    public function edit(Request $request, Informasi $informasi)
    {
        $title = "Informasi - Edit";
        $kategoris = Kategori::get();
        return view('informasi-edit', ['title' => $title, 'informasi' => $informasi, 'kategoris' => $kategoris]);
    }

    public function update(Request $request, Informasi $informasi)
    {
        $this->validate($request, [
            'judul' => 'required',
            'deskripsi' => 'required',
            'isi' => 'required',
            'kategori' => 'required',
            'gambar' => 'max:5048|mimes:jpg,png,jpeg|image'
        ]);

        if ($request->hasFile('gambar')) {
            File::delete('img/informasi' . $informasi->gambar);
            File::delete('img/informasi/medium' . $informasi->gambar);
            File::delete('img/informasi/thumbnail' . $informasi->gambar);

            $file = $request->file('gambar')->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $name = Str::slug($filename) . '-' . time() . '.' . $extension;
            $path = 'img/informasi/';
            $request->file('gambar')->move($path, $name);
            resizeImage($path . $name, 150, $path . 'thumbnail/' . $name);
            resizeImage($path . $name, 400, $path . 'medium/' . $name);
        } else {
            $name = $informasi->gambar;
        }

        $informasi->update([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'deskripsi' => $request->deskripsi,
            'isi' => $request->isi,
            'kategori' => $request->kategori,
            'gambar' => $name,
        ]);

        return redirect('informasi')->with('status', 'Informasi successfully updated!');
    }

    public function destroy(Informasi $informasi)
    {
        File::delete('img/informasi/' . $informasi->gambar);
        File::delete('img/informasi/thumbnail/' . $informasi->gambar);
        File::delete('img/informasi/medium/' . $informasi->gambar);

        $informasi->delete();

        return redirect('informasi')->with('status', 'Informasi successfully deleted!');
    }
}
