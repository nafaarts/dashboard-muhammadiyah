<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use App\Models\DonasiKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DonasiPageController extends Controller
{
    public function index()
    {
        $title = "Donasi";
        $data = Donasi::latest()->paginate(6);
        // dd($data);
        return view('donasi', ['data' => $data, 'title' => $title]);
    }

    public function create()
    {
        $title = "Donasi - Add";
        $kategoris = DonasiKategori::get();
        return view('donasi-create', ['title' => $title, 'kategoris' => $kategoris]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|unique:informasi',
            'target' => 'required|integer',
            'kategori' => 'required|exists:donasi_kategori,id|integer',
            'gambar' => 'required|max:10240|mimes:jpg,png,jpeg|image'
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar')->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $name = Str::slug($filename) . '-' . time() . '.' . $extension;
            $request->file('gambar')->move('img/donasi/', $name);
        }

        Donasi::create([
            'judul' => Str::of($request->judul)->trim(),
            'target' => $request->target,
            'jumlah' => 0,
            'kategori' => $request->kategori,
            'gambar' => $name,
            'slug' => Str::slug($request->judul)
        ]);

        return redirect('donasi')->with('status', 'Donasi successfully added!');
    }

    public function edit(Donasi $donasi)
    {
        $title = "Donasi - Edit";
        $kategoris = DonasiKategori::get();
        return view('donasi-edit', ['title' => $title, 'kategoris' => $kategoris, 'donasi' => $donasi]);
    }

    public function update(Request $request, Donasi $donasi)
    {
        $this->validate($request, [
            'judul' => 'required|unique:informasi',
            'target' => 'required|integer',
            'kategori' => 'required|exists:donasi_kategori,id|integer',
            'gambar' => 'max:10240|mimes:jpg,png,jpeg|image'
        ]);

        if ($request->hasFile('gambar')) {
            File::delete('img/donasi/' . $donasi->gambar);

            $file = $request->file('gambar')->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $name = Str::slug($filename) . '-' . time() . '.' . $extension;
            $request->file('gambar')->move('img/donasi/', $name);
        } else {
            $name = $donasi->gambar;
        }

        $donasi->update([
            'judul' => Str::of($request->judul)->trim(),
            'target' => $request->target,
            'kategori' => $request->kategori,
            'gambar' => $name,
            'slug' => Str::slug($request->judul)
        ]);

        return redirect('donasi')->with('status', 'Donasi successfully updated!');
    }

    public function destroy(Donasi $donasi)
    {
        File::delete('img/donasi/' . $donasi->gambar);

        $donasi->delete();

        return redirect('donasi')->with('success', 'Donasi has been deleted!');
    }
}
