<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sejarah_banjir extends Model
{
    use HasFactory;
    protected $table = 'sejarah_banjir';
    protected $fillable = [
        'id_kecamatan',
        'tanggal',
        'tinggi_air',
        'kerusakan',
        'korban_jiwa',
    ];

    public function kecamatan()
    {
        return $this->hasOne(kecamatan::class, 'id_kecamatan', 'id');
    }
}
