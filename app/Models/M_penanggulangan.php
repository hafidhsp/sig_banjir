<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_penanggulangan extends Model
{
    use HasFactory;
    protected $table = 'tb_penanggulangan';
    protected $casts = [
    'waktu_mulai' => 'datetime',
    'waktu_selesai' => 'datetime',
];
    protected $primaryKey = 'id_penanggulangan';


    protected $fillable = [
        'id_kecamatan',
        'nama_penanggulangan',
        'jenis_penanggulangan',
        'waktu_mulai',
        'waktu_selesai',
        'status_penanggulangan',
        'petugas',
        'anggaran',
        'deskripsi_penanggulangan',
        'bukti_penanggulangan',
    ];
}
