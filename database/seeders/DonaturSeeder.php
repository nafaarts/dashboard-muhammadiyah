<?php

namespace Database\Seeders;

use App\Models\Donasi;
use App\Models\Donatur;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;

class DonaturSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $donasi = collect(Donasi::get())->map(function ($item) {
            return $item->id;
        });
        $faker = Faker::create('id_ID');
        for ($i = 0; $i < 20; $i++) {
            $donasiID = $donasi->random();
            $jumlah = rand(20000, 100000);
            Donatur::create([
                'nama' => $faker->name(),
                'email' => $faker->email(),
                'jumlah' => $jumlah,
                'private' => Arr::random([0, 1]),
                'donasi' => $donasiID
            ]);
            $donasiData = Donasi::findOrFail($donasiID);
            $donasiData->update([
                'jumlah' => $donasiData->jumlah + $jumlah
            ]);
        }
    }
}
