<?php

namespace Database\Seeders;

use App\Models\Informasi;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Gumlet\ImageResize;

class InformasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private function resizeImage($filename, $size, $output)
    {
        $image = new ImageResize($filename);
        $image->resizeToWidth($size, true);
        $image->save($output, IMAGETYPE_JPEG);
    }

    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 0; $i < 20; $i++) {
            $judul = $faker->sentence(15);
            $informasi = Informasi::create([
                'judul' => $judul,
                'slug' => Str::slug($judul),
                'deskripsi' => $faker->paragraph(1),
                'isi' => $faker->paragraph(5),
                'kategori' => Arr::random([1, 2]),
                'gambar' => $faker->image('public/img/informasi', 400, 300, 'people', false),
                'views' => 0,
            ]);
            $gambar = $informasi->gambar;
            $path = 'public/img/informasi/';
            $this->resizeImage($path . $gambar, 150, $path . 'thumbnail/' . $gambar);
            $this->resizeImage($path . $gambar, 400, $path . 'medium/' . $gambar);
        }
    }
}
