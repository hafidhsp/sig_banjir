<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lokasi extends Model
{
    use HasFactory;
    protected $table = 'lokasi';
    protected $fillable = [
        'nama',
        'ketinggian',
        'jenis_tanah',
        'curah_hujan',
        'status_rawan_banjir',
    ];
    public function sejarahBanjir()
    {
        return $this->hasMany(sejarah_banjir::class, 'id_lokasi');
    }

    public function rencana_penanganan()
    {
        return $this->hasMany(rencana_penanganan::class, 'id_lokasi');
    }
}
