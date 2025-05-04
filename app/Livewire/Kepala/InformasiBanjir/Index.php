<?php

namespace App\Livewire\Kepala\InformasiBanjir;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\M_penanggulangan;
use App\Models\M_daerah_banjir;
use App\Models\M_jalan_daerah_banjir;
use App\Models\M_penanganan;
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
    public $today,
           $user,
           $title_modal,
           $id_daerah_banjir,
           $kecamatan_daerah_banjir,
           $nama_pemberi_informasi,
           $id_jalan_daerah_banjir,
           $nama_jalan,
           $nomor_jalan,
           $panjang_jalan,
           $radius,
           $icon,
           $jenis_banjir,
           $tinggi_banjir,
           $bukti_foto,
           $bukti_foto_info,
           $id_daerah_banjir_jalan,
           $detailNamaKecamatan,
           $detailPemberiInformasi,
           $detailWaktu,
           $waktu_mulai,
           $waktu_selesai,
           $id_jalan_daerah_banjir_info,
           $label_nama_jalan,
           $label_nomor_jalan,
           $label_panjang_jalan,
           $label_jenis_banjir,
           $label_tinggi_banjir,
           $label_waktu_mulai,
           $label_waktu_selesai,
           $label_konfirmasi_st,
           $label_long_titude,
           $label_la_titude,
           $buktiFoto,
           $idbuktiFoto,
           $baseLatitude,
           $baseLongtitude,
           $displayjalan,
           $long_atitude,
           $la_atitude,
           $warna_radius,
           $data_jalan_daerah_banjir,
           $id_penanganan,
           $nama_penanganan,
           $nama_petugas,
           $anggaran,
           $deskripsi,
           $bukti_foto_penanganan,
           $bukti_foto_penanganan_info,
           $id_jalan_daerah_banjir_penanganan_info,
           $hide_id_jalan_daerah_banjir,
           $data_penanganan,
           $status_penanganan,
           $idbuktiGambar,
           $detailNamaKepala,
           $buktiGambar
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
        $this->detailCatatanPenanggulangan = '';
        $this->detailWaktu = '';
        $this->resetValidation();
    }

    public function refresh_inputan(){
        $this->mount();
        $this->dispatch('hide-canvas-all');
        $this->dispatch('render-table');
    }

    public function refresh_canvas($form){
        $this->id_jalan_daerah_banjir = '';
        $this->nama_jalan = '';
        $this->nomor_jalan = '';
        $this->panjang_jalan = '';
        $this->waktu_mulai = now()->format('Y-m-d H:i');
        $this->waktu_selesai = '';
        $this->radius = '';
        $this->icon = '';
        $this->jenis_banjir = '';
        $this->tinggi_banjir = '';
        $this->id_jalan_daerah_banjir_info = '';
        $this->label_nama_jalan = '';
        $this->label_nomor_jalan = '';
        $this->label_panjang_jalan = '';
        $this->label_jenis_banjir = '';
        $this->label_tinggi_banjir = '';
        $this->label_konfirmasi_st = '';
        $this->label_waktu_mulai = '';
        $this->label_waktu_selesai = '';
        $this->buktiFoto = [];
        $this->idbuktiFoto = '';
        $this->title_modal = 'Tambah';
        $this->displayjalan = 0;
        $this->baseLatitude = '';
        $this->baseLongtitude = '';
        $this->long_atitude = '';
        $this->la_atitude = '';
        $this->warna_radius = '';
        // $this->data_jalan_daerah_banjir = [];
        $this->id_penanganan = '';
        $this->nama_penanganan = '';
        $this->nama_petugas = '';
        $this->anggaran = '';
        $this->deskripsi = '';
        $this->bukti_foto_penanganan = '';
        $this->bukti_foto_penanganan_info = '';
        $this->id_jalan_daerah_banjir_penanganan_info = '';
        $this->hide_id_jalan_daerah_banjir = '';
        $this->status_penanganan = '';
        if($form == true){
            $this->dispatch('render-canvas-form');
        }else{
            $this->dispatch('render-canvas-utama');
        }
    }


    public function render()
    {
        $today = $this->today;
        $title_modal = $this->title_modal;
        $user = $this->user;
        $no = 1 ;
        $data_daerah_banjir = M_daerah_banjir::select(
                                    'tb_daerah_banjir.*',
                                    'tb_kecamatan.nama_kecamatan',
                                )
                                ->leftJoin('tb_kecamatan','tb_kecamatan.id_kecamatan','=','tb_daerah_banjir.id_kecamatan')
                                ->orderBy('tb_daerah_banjir.created_at', 'Desc')
                                ->get();
        $data_jalan_daerah_banjir =  $this->data_jalan_daerah_banjir;
        $data_kecamatan = kecamatan::orderBy('nama_kecamatan', 'Asc')
                                    ->get();
        $title = 'Informasi Banjir';
        $displayjalan = $this->displayjalan;
        return view('livewire.kepala.informasi-banjir.index',compact('data_daerah_banjir','data_jalan_daerah_banjir','data_kecamatan','no','title_modal','displayjalan','title'))->extends('app_admin',compact('title','today','user'))->section('content');
    }

    public function detailDaerahBanjir($id_daerah_banjir){
        $detailDaerahBanjir = M_daerah_banjir::select('tb_daerah_banjir.*','tb_kecamatan.nama_kecamatan')
                                ->where('id_daerah_banjir',$id_daerah_banjir)
                                ->leftJoin('tb_kecamatan','tb_kecamatan.id_kecamatan','=','tb_daerah_banjir.id_kecamatan')
                                ->first();
        $this->data_jalan_daerah_banjir = M_jalan_daerah_banjir::leftJoin('tb_daerah_banjir','tb_jalan_daerah_banjir.id_daerah_banjir','=','tb_daerah_banjir.id_daerah_banjir')
                                ->where('tb_jalan_daerah_banjir.id_daerah_banjir',$id_daerah_banjir)
                                ->orderBy('tb_jalan_daerah_banjir.created_at', 'Desc')
                                ->get();
                                // dd($this->data_jalan_daerah_banjir);
        $this->id_daerah_banjir_jalan = $id_daerah_banjir;
        $this->detailNamaKecamatan = $detailDaerahBanjir->nama_kecamatan;
        $this->detailPemberiInformasi = $detailDaerahBanjir->pemberi_informasi;
        $this->detailWaktu = !empty($detailDaerahBanjir->created_at)?$detailDaerahBanjir->created_at->translatedformat('d F Y'):'-';
        $this->dispatch('open-canvas-detail-daerah-banjir');
    }

    public function detailJalanDaerahBanjir($id_jalan_daerah_banjir){
        $this->refresh_canvas(false);
        $data__jalan_daerah_banjir = M_jalan_daerah_banjir::from('tb_jalan_daerah_banjir as a')
                                        ->leftJoin('tb_daerah_banjir as b','b.id_daerah_banjir','=','a.id_daerah_banjir')
                                        ->where('a.id_jalan_daerah_banjir',$id_jalan_daerah_banjir)
                                        ->first();
        $data_kecamatan = M_daerah_banjir::from('tb_daerah_banjir as a')
                                        ->leftJoin('tb_kecamatan as b','b.id_kecamatan','=','a.id_kecamatan')
                                        ->where('a.id_daerah_banjir',$data__jalan_daerah_banjir->id_daerah_banjir)
                                        ->first();
        $jenis_banjir ='-';
        if($data__jalan_daerah_banjir->icon == 'mdi mdi-map-marker' ){
            $jenis_banjir ='Normal';
        }else if($data__jalan_daerah_banjir->icon == 'fa-solid fa-water' ){
            $jenis_banjir ='Banjir';
        }else if($data__jalan_daerah_banjir->icon == 'fa-solid fa-house-flood-water'){
            $jenis_banjir ='Banjir Bandang';
        }else{
        $jenis_banjir ='-';
        }
        $this->id_jalan_daerah_banjir_info = $id_jalan_daerah_banjir;
        $this->label_nama_jalan = $data__jalan_daerah_banjir->nama_jalan;
        $this->label_nomor_jalan = $data__jalan_daerah_banjir->nomor_jalan;
        $this->label_panjang_jalan = $data__jalan_daerah_banjir->panjang_jalan;
        $this->label_jenis_banjir = $jenis_banjir;
        $this->label_tinggi_banjir = $data__jalan_daerah_banjir->tinggi_banjir;
        $this->label_waktu_mulai = $data__jalan_daerah_banjir->waktu_mulai
                                    ? $data__jalan_daerah_banjir->waktu_mulai->translatedFormat('d F Y H:i:s') .
                                    ($data__jalan_daerah_banjir->waktu_selesai ? ' - ' . $data__jalan_daerah_banjir->waktu_selesai->translatedFormat('d F Y H:i:s') : '')
                                    : '-';
        $this->label_konfirmasi_st = $data__jalan_daerah_banjir->konfirmasi_st;
        $this->hide_id_jalan_daerah_banjir = $data__jalan_daerah_banjir->id_jalan_daerah_banjir;
        if (!empty($data__jalan_daerah_banjir->bukti_foto)) {
                $this->buktiFoto = explode('#', $data__jalan_daerah_banjir->bukti_foto ?? '');
                $this->idbuktiFoto = $id_jalan_daerah_banjir;
            }
        $this->baseLatitude = $data_kecamatan->la_atitude;
        $this->baseLongtitude = $data_kecamatan->long_atitude;

        //Data Penanganan
        $this->data_penanganan = M_penanganan::where('id_jalan_daerah_banjir',$id_jalan_daerah_banjir)
                                ->orderBy('created_at', 'Desc')
                                ->get();
        $this->dispatch('open-canvas-detail-jalan-daerah-banjir');
        $detail = [
                    'Latitude'=> $data__jalan_daerah_banjir->la_atitude??null,
                    'Longtitude'=> $data__jalan_daerah_banjir->long_atitude??null,
                    'namaJalan'=> $data__jalan_daerah_banjir->nama_jalan??null,
                    'nomorJalan'=> $data__jalan_daerah_banjir->nomor_jalan??null,
                    'panjangJalan'=> $data__jalan_daerah_banjir->panjang_jalan??null,
                    'iconJalan'=> $data__jalan_daerah_banjir->icon??null,
                    'warnaRadius'=> $data__jalan_daerah_banjir->warna_radius??null,
                    'tinggiJalan'=> $data__jalan_daerah_banjir->tinggi_jalan??null,
                    'radiusJalan'=> $data__jalan_daerah_banjir->radius??null,
                    'baseLatitude'=> $data_kecamatan->la_atitude??null,
                    'baseLongtitude'=> $data_kecamatan->long_atitude??null,
                    ];
        $this->dispatch('render-map',$detail);
    }

    // Lokasi All
    public function showDetailLokasiMapsAll($id_daerah_banjir = null){
        $detailDaerahBanjir = [];
        $data_kecamatan = [];
        if($id_daerah_banjir != null){
            $detailDaerahBanjir = M_daerah_banjir::select('a.id_daerah_banjir','a.pemberi_informasi','b.*')
                                    ->from('tb_daerah_banjir as a')
                                    ->leftJoin('tb_jalan_daerah_banjir as b','a.id_daerah_banjir','=','b.id_daerah_banjir')
                                    ->where('a.id_daerah_banjir',$id_daerah_banjir)
                                    ->where('b.konfirmasi_st',1)
                                    ->get();
            $data_kecamatan = M_daerah_banjir::from('tb_daerah_banjir as a')
                                            ->leftJoin('tb_kecamatan as b','b.id_kecamatan','=','a.id_kecamatan')
                                            ->where('a.id_daerah_banjir',$id_daerah_banjir)
                                            ->first();
        }
        $data = [
            'jalan_daerah_banjir' => $detailDaerahBanjir,
            'baseView' => $data_kecamatan,
        ];
        $this->dispatch('render-map-all',$data);
    }

    public function showModalBuktiPenanganan($id_penanganan){
        $data_penanganan = M_penanganan::where('id_penanganan',$id_penanganan)->first();
            if (!empty($data_penanganan->bukti_penanganan)) {
                $this->buktiGambar = explode('#', $data_penanganan->bukti_penanganan ?? '');
                $this->idbuktiGambar = $id_penanganan;
            }
        $this->dispatch('open-modal-bukti-penanganan');
    }
}