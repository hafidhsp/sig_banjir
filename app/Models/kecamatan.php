<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kecamatan extends Model
{
    use HasFactory;
    protected $table = 'kecamatan';
    protected $fillable = [
        'nama_kecamatan',
    ];

    public function sejarahbanjir()
    {
        return $this->belongsTo(sejarah_banjir::class);
    }
}
