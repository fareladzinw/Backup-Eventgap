<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'nama' => 'Fareladzin Wibi Ramadhan',
                'email' => 'fareladzinwibiramadhan@gmail.com',
                'hp' => 82257706877,
                'username' => 'wibi',
                'password' => bcrypt('wibi'),
                'gambar' => null,
            ],
            [
                'nama' => 'user1',
                'email' => 'user1@gmail.com',
                'hp' => 12345,
                'username' => 'user1',
                'password' => bcrypt('user1'),
                'gambar' => null,
            ],
            [
                'nama' => 'user2',
                'email' => 'user2@gmail.com',
                'hp' => 12345,
                'username' => 'user2',
                'password' => bcrypt('user2'),
                'gambar' => null,
            ]
        ]);
    }
}
