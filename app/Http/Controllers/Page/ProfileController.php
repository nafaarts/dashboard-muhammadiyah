<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        $title = "Profile";
        return view('profile', ['title' => $title, 'profile' => auth()->user()]);
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);

        Auth::logout();

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

        return redirect('login');
    }
}
