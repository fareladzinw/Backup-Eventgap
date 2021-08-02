<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategoris')->insert([
            [
                'namaKategori' => 'Education',
            ],
            [
                'namaKategori' => 'Health',
            ],
            [
                'namaKategori' => 'Sport',
            ],
            [
                'namaKategori' => 'Anusement',
            ],
            [
                'namaKategori' => 'Job Vacancy',
            ],
            [
                'namaKategori' => 'Tourism',
            ]
        ]);
    }
}
