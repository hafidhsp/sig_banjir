<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kecamatan extends Model
{
    use HasFactory;
    protected $table = 'tb_kecamatan';
    protected $primaryKey = 'id_kecamatan';
    protected $fillable = [
        'nama_kecamatan',
        'long_atitude',
        'la_atitude',
        'icon',
        'radius',
        'warna_radius',
    ];

    public function sejarahbanjir()
    {
        return $this->belongsTo(sejarah_banjir::class);
    }
}
