<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rencana_penanganan extends Model
{
    use HasFactory;
    protected $table = 'rencana_penanganan';
    protected $fillable = [
        'id_sejarah_banjir',
        'institusi',
        'upaya',
    ];

    public function sejarahbanjir()
    {
        return $this->belongsTo(sejarah_banjir::class, 'id_sejarah_banjir', 'id');
    }
}
