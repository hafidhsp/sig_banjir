<?php

namespace App\Livewire\Landing;

use Livewire\Component;
use App\Models\M_jalan_daerah_banjir;

class Index extends Component
{
    public  $waktu_mulai,
            $waktu_selesai;

    public function mount()
    {
        $this->waktu_mulai = now()->format('Y-m-d');
        $this->waktu_selesai = now()->format('Y-m-d');
    }

    protected $listeners = ['setWaktuMulai', 'setWaktuSelesai'];

    public function setWaktuMulai($date)
    {
        $this->waktu_mulai = $date;
    }

    public function setWaktuSelesai($date)
    {
        $this->waktu_selesai = $date;
    }

    public function render()
    {
        $now = now()->format('Y-m-d');
        // $waktu_selesai =$this->waktu_selesai ;
        $data = M_jalan_daerah_banjir::all()
                                        ->where('konfirmasi_st', '=', 1);
        // dd($data);
        return view('livewire.landing.index',compact('now','data'))->extends('app_landing')->section('content');
    }
}
