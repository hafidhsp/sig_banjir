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
                'long_atitude' => '109.1372914',
                'la_atitude' => '-7.663439',
                'icon' => 'mdi mdi-map-marker',
            ],
            [
                'nama_kecamatan' => 'Bantarsari',
                'long_atitude' => '108.870536',
                'la_atitude' => '-7.539583',
                'icon' => 'fa-solid fa-water',
            ],
            [
                'nama_kecamatan' => 'Binangun',
                'long_atitude' => '109.034487',
                'la_atitude' => '-7.684901',
                'icon' => 'fa-solid fa-house-flood-water',
            ],
            [
                'nama_kecamatan' => 'Cilacap Selatan',
                'long_atitude' => '',
                'la_atitude' => '',
                'icon' => '',
            ],
            [
                'nama_kecamatan' => 'Cilacap Tengah',
                'long_atitude' => '',
                'la_atitude' => '',
                'icon' => '',
            ],
            [
                'nama_kecamatan' => 'Cilacap Utara',
                'long_atitude' => '',
                'la_atitude' => '',
                'icon' => '',
            ],
            [
                'nama_kecamatan' => 'Cimanggu',
                'long_atitude' => '',
                'la_atitude' => '',
                'icon' => '',
            ],
            [
                'nama_kecamatan' => 'Cipari',
                'long_atitude' => '',
                'la_atitude' => '',
                'icon' => '',
            ],
            [
                'nama_kecamatan' => 'Dayeuhluhur',
                'long_atitude' => '',
                'la_atitude' => '',
                'icon' => '',
            ],
            [
                'nama_kecamatan' => 'Gandrungmangu',
                'long_atitude' => '',
                'la_atitude' => '',
                'icon' => '',
            ],
            [
                'nama_kecamatan' => 'Jeruk legi',
                'long_atitude' => '',
                'la_atitude' => '',
                'icon' => '',
            ],
            [
                'nama_kecamatan' => 'Kampung laut',
                'long_atitude' => '',
                'la_atitude' => '',
                'icon' => '',
            ],
            [
                'nama_kecamatan' => 'Karangpucung',
                'long_atitude' => '',
                'la_atitude' => '',
                'icon' => '',
            ],
            [
                'nama_kecamatan' => 'Kawunganten',
                'long_atitude' => '',
                'la_atitude' => '',
                'icon' => '',
            ],
            [
                'nama_kecamatan' => 'Kedungreja',
                'long_atitude' => '',
                'la_atitude' => '',
                'icon' => '',
            ],
            [
                'nama_kecamatan' => 'Kesugihan',
                'long_atitude' => '',
                'la_atitude' => '',
                'icon' => '',
            ],
            [
                'nama_kecamatan' => 'Kroya',
                'long_atitude' => '',
                'la_atitude' => '',
                'icon' => '',
            ],
            [
                'nama_kecamatan' => 'Majenang',
                'long_atitude' => '',
                'la_atitude' => '',
                'icon' => '',
            ],
            [
                'nama_kecamatan' => 'Maos',
                'long_atitude' => '',
                'la_atitude' => '',
                'icon' => '',
            ],
            [
                'nama_kecamatan' => 'Nusawungu',
                'long_atitude' => '',
                'la_atitude' => '',
                'icon' => '',
            ],
            [
                'nama_kecamatan' => 'Patimuan',
                'long_atitude' => '',
                'la_atitude' => '',
                'icon' => '',
            ],
            [
                'nama_kecamatan' => 'Sampang',
                'long_atitude' => '',
                'la_atitude' => '',
                'icon' => '',
            ],
            [
                'nama_kecamatan' => 'Sidareja',
                'long_atitude' => '',
                'la_atitude' => '',
                'icon' => '',
            ],
            [
                'nama_kecamatan' => 'Wanareja',
                'long_atitude' => '',
                'la_atitude' => '',
                'icon' => '',
            ],
        ]);
    }
}
