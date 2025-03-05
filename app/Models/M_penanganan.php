<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_penanganan extends Model
{
    use HasFactory;
    protected $table = 'tb_penanganan';
    protected $primaryKey = 'id_penanganan';
        protected $casts = [
        'konfirmasi_st' => 'boolean',
        'created_at' => 'datetime',
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];
    protected $fillable = [
        'id_jalan_daerah_banjir',
        'nama_penanganan',
        'waktu_mulai',
        'waktu_selesai',
        'status_penanganan',
        'petugas',
        'anggaran',
        'deskripsi_penanganan',
        'konfirmasi_st',
        'bukti_penanganan',
    ];
}
