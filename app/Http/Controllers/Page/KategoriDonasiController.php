<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\DonasiKategori;
use Illuminate\Http\Request;

class KategoriDonasiController extends Controller
{
    public function index()
    {
        $title = "Kategori Donasi";
        $data = DonasiKategori::latest()->paginate(6);
        return view('kategori-donasi', ['title' => $title, 'data' => $data]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kategori' => 'required|unique:kategori'
        ]);

        DonasiKategori::create(['kategori' => $request->kategori]);

        return redirect('kategori-donasi')->with('status', 'Kategori successfully added!');
    }

    public function update(Request $request)
    {
        $kategori = DonasiKategori::findOrFail($request->id);
        $kategori->update(['kategori' => $request->kategori]);
        return redirect('kategori-donasi')->with('status', 'Kategori successfully updated!');
    }

    public function destroy($id)
    {
        $kategori = DonasiKategori::findOrFail($id);
        $kategori->delete();
        return redirect('kategori-donasi')->with('status', 'Kategori has been deleted!');
    }
}
