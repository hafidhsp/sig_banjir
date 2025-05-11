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
        'konfirmasi_st' => 'boolean',
        'created_at' => 'datetime',
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];
    protected $fillable = [
        // 'id_daerah_banjir',
        'nama_jalan',
        'nomor_jalan',
        'panjang_jalan',
        'tingkat_banjir',
        'tinggi_banjir',
        'bukti_foto',
        'waktu_mulai',
        'waktu_selesai',
        'warna_radius',
        'long_atitude',
        'la_atitude',
        'icon',
        'radius',
        'konfirmasi_st',
        // Start Revisi Merge
        'id_kecamatan',
        'pemberi_informasi',
        'batal_st',
        // End Revisi Merge
        // STart Revisi Catatan Kepala
        'jalan_daerah_banjir_catatan_kepala',
        'jalan_daerah_banjir_kepala_id',
        // ENd Revisi Catatan Kepala
    ];
}
