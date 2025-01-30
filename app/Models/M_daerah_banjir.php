<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_daerah_banjir extends Model
{
    use HasFactory;
    protected $table = 'tb_daerah_banjir';
    protected $primaryKey = 'id_daerah_banjir';
    protected $fillable = [
        'id_kecamatan',
        'pemberi_informasi',
        'batal_st',
        'created_at',
    ];

}
