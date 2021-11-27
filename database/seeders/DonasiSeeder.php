<?php

namespace Database\Seeders;

use App\Models\Donasi;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class DonasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 0; $i < 12; $i++) {
            $judul = $faker->sentence(7);
            $target = $faker->randomNumber();
            Donasi::create([
                'judul' => Str::of($judul)->trim(),
                'target' => $target,
                'jumlah' => $faker->numberBetween(0, $target),
                'kategori' => Arr::random([1, 2]),
                'gambar' => $faker->image('public/img/donasi', 400, 300, 'people', false),
                'slug' => Str::slug($judul)
            ]);
        }
    }
}
