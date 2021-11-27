<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use App\Models\Donatur;
use Illuminate\Http\Request;

class DonaturController extends Controller
{
    public function index(Donasi $donasi)
    {
        $title = 'Donatur';
        $data = Donatur::where('donasi', $donasi->id)->latest()->paginate(6);
        return view('donatur', ['title' => $title, 'data' => $data, 'donasi' => $donasi]);
    }

    public function create(Donasi $donasi)
    {
        $title = 'Donatur - Add';
        return view('donatur-create', ['title' => $title, 'donasi' => $donasi]);
    }

    public function store(Request $request, Donasi $donasi)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'jumlah' => 'required|numeric',
        ]);

        Donatur::create([
            'nama' => $request->name,
            'email' => $request->email,
            'jumlah' => $request->jumlah,
            'private' => 0,
            'donasi' => $donasi->id
        ]);

        $donasi->update([
            'jumlah' => $donasi->jumlah + $request->jumlah
        ]);

        return redirect('donatur/' . $donasi->id)->with('status', 'Donatur successfully added!');
    }

    public function edit(Donatur $donatur)
    {
        $title = 'Donatur - Edit';
        return view('donatur-edit', ['title' => $title, 'donatur' => $donatur]);
    }

    public function update(Request $request, Donatur $donatur)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'jumlah' => 'required|numeric'
        ]);

        $donasi = Donasi::findOrFail($donatur->donasi);
        $donasi->update([
            'jumlah' => ($donasi->jumlah - $donatur->jumlah) + $request->jumlah
        ]);

        $donatur->update([
            'nama' => $request->name,
            'email' => $request->email,
            'jumlah' => $request->jumlah
        ]);

        return redirect('donatur/' . $donasi->id)->with('status', 'Donatur successfully updated!');
    }

    public function destroy(Donatur $donatur)
    {
        $donasi = Donasi::findOrFail($donatur->donasi);
        $donasi->update([
            'jumlah' => $donasi->jumlah - $donatur->jumlah
        ]);

        $donatur->delete();
        return redirect('donatur/' . $donasi->id)->with('status', 'Donatur has been deleted!');
    }
}
