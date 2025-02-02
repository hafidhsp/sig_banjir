<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_jalan_daerah_banjir extends Model
{
    use HasFactory;
    protected $table = 'tb_jalan_daerah_banjir';
    protected $primaryKey = 'id_jalan_daerah_banjir';
    protected $casts = [
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];
    protected $fillable = [
        'id_daerah_banjir',
        'nama_jalan',
        'nomor_jalan',
        'panjang_jalan',
        'tingkat_banjir',
        'tinggi_banjir',
        'bukti_foto',
    ];
}
