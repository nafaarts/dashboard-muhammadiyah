<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriInformasiController extends Controller
{
    public function index()
    {
        $title = "Kategori Informasi";
        $data = Kategori::latest()->paginate(6);
        return view('kategori-informasi', ['title' => $title, 'data' => $data]);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'kategori' => 'required|unique:kategori'
        ]);

        Kategori::create(['kategori' => $request->kategori]);

        return redirect('kategori-informasi')->with('status', 'Kategori successfully added!');
    }

    public function update(Request $request)
    {
        $kategori = Kategori::findOrFail($request->id);
        $kategori->update(['kategori' => $request->kategori]);
        return redirect('kategori-informasi')->with('status', 'Kategori successfully updated!');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return redirect('kategori-informasi')->with('status', 'Kategori has been deleted!');
    }
}
