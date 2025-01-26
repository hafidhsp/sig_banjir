<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_penanganan extends Model
{
    use HasFactory;
    protected $table = 'tb_penanganan';
    protected $fillable = [
        'id_daerah_banjir',
        'nama_penanganan',
        'jenis_penanganan',
        'waktu_mulai',
        'waktu_selesai',
        'status_penanganan',
        'petugas',
        'anggaran',
        'deskripsi_penanganan',
        'bukti_penanganan',
    ];
}
