<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TiketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tikets')->insert([
            [
                'eventId' => 1,
                'namatiket' => 'Tiket 1.1',
                'deskripsi' => 'blablablabla',
                'harga' => 75000,
                'qty' => 100,
                'dateTime' => Carbon::now(),
                'gambar' => "0.jpg"
            ],
            [
                'eventId' => 1,
                'namatiket' => 'Tiket 1.2',
                'deskripsi' => 'blablablabla',
                'harga' => 50000,
                'qty' => 50,
                'dateTime' => Carbon::now(),
                'gambar' => "0.jpg"
            ],
            [
                'eventId' => 2,
                'namatiket' => 'Tiket 2.1',
                'deskripsi' => 'blablablabla',
                'harga' => 75000,
                'qty' => 100,
                'dateTime' => Carbon::now(),
                'gambar' => "0.jpg"
            ],
            [
                'eventId' => 3,
                'namatiket' => 'Tiket 3.1',
                'deskripsi' => 'blablablabla',
                'harga' => 75000,
                'qty' => 100,
                'dateTime' => Carbon::now(),
                'gambar' => "0.jpg"
            ]
        ]);
    }
}
