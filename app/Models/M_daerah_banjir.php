<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_daerah_banjir extends Model
{
    use HasFactory;
    protected $table = 'tb_daerah_banjir';
    protected $casts = [
        'created_at' => 'datetime',
    ];
    protected $dates = ['created_at','daerah_created_at'];
    protected $fillable = [
        'id_kecamatan',
        'pemberi_informasi',
        'batal_st',
        'created_at',
    ];

}
