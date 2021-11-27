<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersManagementController extends Controller
{
    public function index()
    {
        $data = User::where('id', '!=', auth()->user()->id)
            ->where('email', '!=', 'naufal@nafaarts.com')
            ->latest()->paginate(6);
        $title = "Admin Management";
        return view('admin-management', ['title' => $title, 'data' => $data]);
    }

    public function create()
    {
        $title = "Admin Management - Add";
        return view('admin-management-create', ['title' => $title]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'gambar' => 'required|max:5048|mimes:jpg,png,jpeg|image'
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar')->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $name = Str::slug($filename) . '-' . time() . '.' . $extension;
            $path = 'img/users/';
            $request->file('gambar')->move($path, $name);
        }

        User::create([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gambar' => $name
        ]);

        return redirect('/admin-management')->with('status', 'Admin successfully added!');
    }

    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $title = "Admin Management - Edit";
        return view('admin-management-edit', ['title' => $title, 'user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'confirmed',
            'gambar' => 'max:5048|mimes:jpg,png,jpeg|image'
        ]);

        if ($request->hasFile('gambar')) {
            File::delete('img/users/' . $user->gambar);

            $file = $request->file('gambar')->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $name = Str::slug($filename) . '-' . time() . '.' . $extension;

            $request->file('gambar')->move('img/users/', $name);
        } else {
            $name = $user->gambar;
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'gambar' => $name,
            'password' => ($request->password) ? Hash::make($request->password) : $user->password
        ];

        $user->update($data);

        return redirect('/admin-management')->with('status', 'Admin has been updated!');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);

        File::delete('img/users/' . $user->gambar);
        $user->delete();

        return redirect('/admin-management')->with('status', 'Admin has been deleted!');
    }
}
