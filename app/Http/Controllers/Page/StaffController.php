<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class StaffController extends Controller
{
    public function index()
    {
        $title = "Staff";
        $data = Staff::paginate(6);
        return view('staff', ['title' => $title, 'data' => $data]);
    }

    public function create()
    {
        $title = "Staff - Add";
        return view('staff-create', ['title' => $title]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'jabatan' => 'required',
            'phone' => 'required|numeric',
            'gambar' => 'required|max:5048|mimes:jpg,png,jpeg|image'
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar')->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $name = Str::slug($filename) . '-' . time() . '.' . $extension;
            $request->file('gambar')->move('img/staff/', $name);
        }

        Staff::create([
            'name' => $request->name,
            'jabatan' => $request->jabatan,
            'phone' => $request->phone,
            'gambar' => $name,
        ]);

        return redirect('/staff')->with('status', 'Staff successfully added!');
    }

    public function edit(Staff $staff)
    {
        $title = "Staff - Edit";
        return view('staff-edit', ['title' => $title, 'staff' => $staff]);
    }

    public function update(Request $request, Staff $staff)
    {
        $this->validate($request, [
            'name' => 'required',
            'jabatan' => 'required',
            'phone' => 'required|numeric',
            'gambar' => 'max:5048|mimes:jpg,png,jpeg|image'
        ]);

        if ($request->hasFile('gambar')) {
            File::delete('img/staff' . $staff->gambar);

            $file = $request->file('gambar')->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $name = Str::slug($filename) . '-' . time() . '.' . $extension;
            $request->file('gambar')->move('img/staff/', $name);
        } else {
            $name = $staff->gambar;
        }


        $staff->update([
            'name' => $request->name,
            'jabatan' => $request->jabatan,
            'phone' => $request->phone,
            'gambar' => $name,
        ]);

        return redirect('/staff')->with('status', 'Staff successfully updated!');
    }

    public function destroy(Staff $staff)
    {
        File::delete('img/staff' . $staff->gambar);
        $staff->delete();
        return redirect('/staff')->with('status', 'Staff successfully deleted!');
    }
}
