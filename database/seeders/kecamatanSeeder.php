<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class kecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('tb_kecamatan')->insert([
            [
                'nama_kecamatan' => 'Adipala',
            ],
            [
                'nama_kecamatan' => 'Bantarsari',
            ],
            [
                'nama_kecamatan' => 'Binangun',
            ],
            [
                'nama_kecamatan' => 'Cilacap Selatan',
            ],
            [
                'nama_kecamatan' => 'Cilacap Tengah',
            ],
            [
                'nama_kecamatan' => 'Cilacap Utara',
            ],
            [
                'nama_kecamatan' => 'Cimanggu',
            ],
            [
                'nama_kecamatan' => 'Cipari',
            ],
            [
                'nama_kecamatan' => 'Dayeuhluhur',
            ],
            [
                'nama_kecamatan' => 'Gandrungmangu',
            ],
            [
                'nama_kecamatan' => 'Jeruk legi',
            ],
            [
                'nama_kecamatan' => 'Kampung laut',
            ],
            [
                'nama_kecamatan' => 'Karangpucung',
            ],
            [
                'nama_kecamatan' => 'Kawunganten',
            ],
            [
                'nama_kecamatan' => 'Kedungreja',
            ],
            [
                'nama_kecamatan' => 'Kesugihan',
            ],
            [
                'nama_kecamatan' => 'Kroya',
            ],
            [
                'nama_kecamatan' => 'Majenang',
            ],
            [
                'nama_kecamatan' => 'Maos',
            ],
            [
                'nama_kecamatan' => 'Nusawungu',
            ],
            [
                'nama_kecamatan' => 'Patimuan',
            ],
            [
                'nama_kecamatan' => 'Sampang',
            ],
            [
                'nama_kecamatan' => 'Sidareja',
            ],
            [
                'nama_kecamatan' => 'Wanareja',
            ],
        ]);
    }
}
