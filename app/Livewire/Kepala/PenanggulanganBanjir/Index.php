<?php

namespace App\Livewire\Kepala\PenanggulanganBanjir;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\M_penanggulangan;
use App\Models\M_daerah_banjir;
use App\Models\M_jalan_daerah_banjir;
use App\Models\kecamatan;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{

    public $user,
           $today,
           $title_modal,
           $idbuktiGambar,
           $buktiGambar,
           $id_penanggulangan,
           $penanggulangan_catatan_kepala,
           $detailNamaKecamatan,
           $detailNamaPenanggulangan,
           $detailJenisPenanggulangan,
           $detailCatatanPenanggulangan,
           $detailWaktu
           ;

    public function mount(){
        $this->today = Carbon::now()->translatedFormat('d F Y');
        $this->user = Auth::user();
        $this->title_modal = 'Tambah';
        $this->buktiGambar = '';
        $this->idbuktiGambar = '';
        $this->id_penanggulangan = '';
        $this->penanggulangan_catatan_kepala = '';
        $this->detailNamaKecamatan = '';
        $this->detailNamaPenanggulangan = '';
        $this->detailJenisPenanggulangan = '';
        $this->detailWaktu = '';
        $this->detailCatatanPenanggulangan = '';
        $this->resetValidation();
    }

    public function refresh_inputan(){
        $this->mount();
        $this->dispatch('render-table');
    }

    public function render()
    {
        $this->title_modal = 'Tambah';
        $no = 1 ;
        $user = $this->user;
        $data_penanggulangan = M_penanggulangan::orderBy('tb_penanggulangan.created_at', 'Desc')
                                ->leftJoin('tb_kecamatan','tb_kecamatan.id_kecamatan','=','tb_penanggulangan.id_kecamatan')
                                ->get();
        $data_kecamatan = kecamatan::orderBy('nama_kecamatan', 'Asc')
                                    ->get();
        $today = $this->today;
        $title_modal = $this->title_modal;
        $title = 'Penanggulangan Banjir';
        return view('livewire.kepala.penanggulangan-banjir.index',compact('data_penanggulangan','data_kecamatan','no','title_modal','title'))->extends('app_admin',compact('title','today','user'))->section('content');
    }

    public function showModalBuktiPenanggulangan($id_penanggulangan){
        $data_penanggulangan = M_penanggulangan::where('id_penanggulangan',$id_penanggulangan)->first();
            if (!empty($data_penanggulangan->bukti_penanggulangan)) {
                $this->buktiGambar = explode('#', $data_penanggulangan->bukti_penanggulangan ?? '');
                $this->idbuktiGambar = $id_penanggulangan;
            }
        $this->dispatch('open-modal-bukti-penanggulangan');
    }

    public function showDetailPenanggulanganBanjir($id_penanggulangan){
        $detailPenanggulangan = M_penanggulangan::select('tb_penanggulangan.*','tb_kecamatan.nama_kecamatan')
                                ->where('id_penanggulangan',$id_penanggulangan)
                                ->leftJoin('tb_kecamatan','tb_kecamatan.id_kecamatan','=','tb_penanggulangan.id_kecamatan')
                                ->first();
        // dd($detailPenanggulangan);
        $this->id_penanggulangan = $id_penanggulangan;
        $this->detailNamaKecamatan = $detailPenanggulangan->nama_kecamatan;
        $this->detailNamaPenanggulangan = $detailPenanggulangan->nama_penanggulangan;
        $this->detailJenisPenanggulangan = $detailPenanggulangan->jenis_penanggulangan;
        $this->penanggulangan_catatan_kepala = $detailPenanggulangan->penanggulangan_catatan_kepala;
        $this->detailWaktu = !empty($detailPenanggulangan->waktu_mulai)?$detailPenanggulangan->waktu_mulai->translatedformat('d F Y'):'-';
        $this->dispatch('open-canvas-utama');
    }

    public function save_catatan_penanggulangan()
    {
        if($this->id_penanggulangan){
            $data_penanggulangan = M_penanggulangan::where('id_penanggulangan',$this->id_penanggulangan)->first();
            $data = [
                'penanggulangan_kepala_id' => Auth::user()->id,
                'penanggulangan_catatan_kepala' => $this->penanggulangan_catatan_kepala,
            ];
            // dd($data);
            $data_penanggulangan->update($data);
            $this->dispatch('open-notif-success-canvas');

        }
    }
}
