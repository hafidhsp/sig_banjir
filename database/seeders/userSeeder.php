<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'nama_lengkap' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'admin',
            ],
            [
                'nama_lengkap' => 'hafidh',
                'email' => 'hafidh@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'user',
            ],
            [
                'nama_lengkap' => 'syahputra',
                'email' => 'syahputra@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'kepala',
            ],
        ]);
    }
}
