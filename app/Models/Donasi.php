<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    protected $table = 'donasi';
    protected $fillable = ['judul', 'target', 'jumlah', 'kategori', 'slug', 'gambar'];

    function categories()
    {
        return $this->belongsTo(DonasiKategori::class, 'kategori');
    }

    function donatur()
    {
        return $this->hasMany(Donatur::class, 'donasi');
    }
}
