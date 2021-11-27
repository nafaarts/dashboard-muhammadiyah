<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Gumlet\ImageResize;

class GallerySeeder extends Seeder
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
        $faker = Faker::create('id-ID');
        for ($i = 0; $i < 14; $i++) {
            $gallery = Gallery::create([
                'deskripsi' => $faker->sentence(4),
                'gambar' => $faker->image('public/img/gallery', 400, 300, 'people', false),
            ]);
            $gambar = $gallery->gambar;
            $path = 'public/img/gallery/';
            $this->resizeImage($path . $gambar, 150, $path . 'thumbnail/' . $gambar);
            $this->resizeImage($path . $gambar, 400, $path . 'medium/' . $gambar);
        }
    }
}
