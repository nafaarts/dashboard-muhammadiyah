<?php

namespace App\Http\Controllers;

use App\Models\Staff;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::get();
        $data = collect($staff)->map(function ($item) {
            return collect($item)->merge(['gambar' => asset('img/staff/' . $item->gambar)]);
        });
        return response([
            'success' => true,
            'message' => 'Staff list',
            'count' => $staff->count(),
            'data'   => $data
        ], 200);
    }
}
