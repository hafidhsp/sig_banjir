<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_daerah_banjir extends Model
{
    use HasFactory;
    protected $table = 'tb_daerah_banjir';
    protected $fillable = [
        'id_kecamatan',
        'waktu_mulai',
        'waktu_selesai',
        'pemberi_informasi',
        'radius_daerah_banjir',
        'warna_radius',
        'konfirasi_st',
    ];

}
