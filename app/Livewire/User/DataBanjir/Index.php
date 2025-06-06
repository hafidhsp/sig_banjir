<?php

namespace App\Livewire\User\DataBanjir;

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
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public  $today,
            $user,
            $title_modal,
            $tanggal_awal,
            $tanggal_akhir,
            $data_daerah_banjir,
            $data_jalan_daerah_banjir,
            $id_daerah_banjir_jalan,
            $detailNamaKecamatan,
            $detailPemberiInformasi,
            $detailWaktu,
            $baseLatitude,
            $baseLongtitude,
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
            $displayjalan,
            $long_atitude,
            $la_atitude,
            $detailNamaKepala,
            $jalan_daerah_banjir_catatan_kepala,
            $data_penanganan,
            $warna_radius
           ;

    public function mount()
    {
        $this->today = Carbon::now()->format('d F Y');
        $this->user = Auth::user();
        $this->title_modal = 'Data Banjir';
        $this->tanggal_awal = Carbon::now()->format('Y-m-d');
        $this->tanggal_akhir = Carbon::now()->format('Y-m-d');
        $this->data_daerah_banjir = [];
        $this->data_penanganan = [];
        $this->data_jalan_daerah_banjir = [];
        $this->id_daerah_banjir_jalan = '';
        $this->detailNamaKecamatan = '';
        $this->detailPemberiInformasi = '';
        $this->detailWaktu = '';
        $this->baseLatitude = '';
        $this->baseLongtitude = '';
        $this->id_jalan_daerah_banjir_info = '';
        $this->label_nama_jalan = '';
        $this->label_nomor_jalan = '';
        $this->label_panjang_jalan = '';
        $this->label_jenis_banjir = '';
        $this->label_tinggi_banjir = '';
        $this->label_konfirmasi_st = '';
        $this->label_waktu_mulai = '';
        $this->label_waktu_selesai = '';
        $this->displayjalan = 0;
        $this->long_atitude = '';
        $this->la_atitude = '';
        $this->warna_radius = '';
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date',
        ]);
    }
    public function updatedTanggalAwal($value)
    {
        $this->tanggal_awal = $value;
        $this->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);
        if ($this->isValidDateRange()) {
            $this->daerah_banjir();
            // $this->dispatch('ref-table');
        }
    }
    public function updatedTanggalAkhir($value)
    {
        $this->tanggal_akhir = $value;
        $this->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);
        if ($this->isValidDateRange()) {
            $this->daerah_banjir();
            // $this->dispatch('render-table');
        }
    }

    private function isValidDateRange()
    {
        return strtotime($this->tanggal_akhir) >= strtotime($this->tanggal_awal);
    }

    private function daerah_banjir()
    {

        $data_banjir = M_jalan_daerah_banjir::
                                //   leftJoin('tb_daerah_banjir','tb_jalan_daerah_banjir.id_daerah_banjir','=','tb_daerah_banjir.id_daerah_banjir')
                                leftJoin('tb_kecamatan','tb_jalan_daerah_banjir.id_kecamatan','=','tb_kecamatan.id_kecamatan')
                                // ->whereBetween('tb_jalan_daerah_banjir.waktu_mulai', [$this->tanggal_awal.'00:00:00', $this->tanggal_akhir.'24:59:59'])
                                ->whereBetween('tb_jalan_daerah_banjir.waktu_mulai', [
                                    Carbon::parse($this->tanggal_awal)->startOfDay(),  // Memastikan tanggal_awal adalah mulai hari (00:00:00)
                                    Carbon::parse($this->tanggal_akhir)->endOfDay()   // Memastikan tanggal_akhir adalah akhir hari (23:59:59)
                                ])
                                ->orderBy('tb_jalan_daerah_banjir.created_at', 'Desc')
                                ->where('tb_jalan_daerah_banjir.konfirmasi_st',1)
                                ->get();
        return $data_banjir;
    }


    public function refresh_inputan(){
        $this->mount();
        $this->dispatch('hide-canvas-all');
        $this->dispatch('render-table');
        $this->dispatch('refresh-table');
    }
    public function refresh_canvas($hide_all = false){
        // if($hide_all) {
            $this->dispatch('hide-canvas-all');
        // }else{
        //     $this->dispatch('hide-canvas-detail');
        // }
        $this->dispatch('render-table');
        $this->dispatch('refresh-table');
    }


    public function render()
    {
        $today = $this->today;
        $title_modal = $this->title_modal;
        $user = $this->user;
        $title = 'Data Banjir';
        $no = 1 ;
        $this->data_daerah_banjir = $this->daerah_banjir();
        // dd($this->data_daerah_banjir);
        // $data_daerah_banjir = M_daerah_banjir::select(
        //                             'tb_daerah_banjir.*',
        //                             'tb_kecamatan.nama_kecamatan',
        //                         )
        //                         ->leftJoin('tb_kecamatan','tb_kecamatan.id_kecamatan','=','tb_daerah_banjir.id_kecamatan')
        //                         ->orderBy('tb_daerah_banjir.created_at', 'Desc')
        //                         ->get();
        // $this->dispatch('render-table');
        return view('livewire.user.data-banjir.index',compact('title','no'))->extends('app_admin',compact('title','today','user'))->section('content');
    }

    public function detailDaerahBanjir($id_jalan_daerah_banjir){
        $detailDaerahBanjir = M_jalan_daerah_banjir::select('tb_jalan_daerah_banjir.*','tb_kecamatan.nama_kecamatan')
                                ->leftJoin('tb_kecamatan','tb_kecamatan.id_kecamatan','=','tb_jalan_daerah_banjir.id_kecamatan')
                                ->where('id_jalan_daerah_banjir',$id_jalan_daerah_banjir)
                                ->first();
                                // dd();
        // $detailDaerahBanjir = M_daerah_banjir::select('tb_daerah_banjir.*','tb_kecamatan.nama_kecamatan')
        //                         ->where('id_daerah_banjir',$id_daerah_banjir)
        //                         ->leftJoin('tb_kecamatan','tb_kecamatan.id_kecamatan','=','tb_daerah_banjir.id_kecamatan')
        //                         ->first();
        $this->data_jalan_daerah_banjir = M_jalan_daerah_banjir::
                                // leftJoin('tb_daerah_banjir','tb_jalan_daerah_banjir.id_daerah_banjir','=','tb_daerah_banjir.id_daerah_banjir')
                                where('tb_jalan_daerah_banjir.id_jalan_daerah_banjir',$id_jalan_daerah_banjir)
                                ->orderBy('tb_jalan_daerah_banjir.created_at', 'Desc')
                                ->get();
                                // dd($this->data_jalan_daerah_banjir);
        $this->id_daerah_banjir_jalan = $id_jalan_daerah_banjir;
        $this->detailNamaKecamatan = $detailDaerahBanjir->nama_kecamatan;
        $this->detailPemberiInformasi = $detailDaerahBanjir->pemberi_informasi;
        $this->detailWaktu = !empty($detailDaerahBanjir->created_at)?$detailDaerahBanjir->created_at->translatedformat('d F Y'):'-';
        // $this->dispatch('render-table');
        $this->dispatch('open-canvas-detail-daerah-banjir');
    }

    public function detailJalanDaerahBanjir($id_jalan_daerah_banjir){
        $data__jalan_daerah_banjir = M_jalan_daerah_banjir::select(
                                                            'tb_jalan_daerah_banjir.*',
                                                            'tb_kecamatan.nama_kecamatan',
                                                            'users.nama_lengkap',
                                                        )
                                                        ->leftJoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_jalan_daerah_banjir.id_kecamatan')
                                                        ->leftJoin('users', 'users.id', '=', DB::raw("CAST(tb_jalan_daerah_banjir.jalan_daerah_banjir_kepala_id AS UNSIGNED)"))
                                                        ->where('tb_jalan_daerah_banjir.id_jalan_daerah_banjir', $id_jalan_daerah_banjir)
                                                        ->first();
        $data_kecamatan = M_daerah_banjir::from('tb_jalan_daerah_banjir as a')
                                        ->leftJoin('tb_kecamatan as b','b.id_kecamatan','=','a.id_kecamatan')
                                        ->where('a.id_jalan_daerah_banjir',$data__jalan_daerah_banjir->id_jalan_daerah_banjir)
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
        $this->detailWaktu = $data__jalan_daerah_banjir->waktu_mulai->translatedformat('d F Y H:i').' - '.(!empty($data__jalan_daerah_banjir->waktu_selesai)?$data__jalan_daerah_banjir->waktu_selesai->translatedformat('d F Y'):'');
        $this->jalan_daerah_banjir_catatan_kepala = $data__jalan_daerah_banjir->jalan_daerah_banjir_catatan_kepala;
        $this->detailNamaKepala = $data__jalan_daerah_banjir->users.$data__jalan_daerah_banjir->nama_lengkap;
        //Data Penanganan
        $this->data_penanganan = M_penanganan::where('id_jalan_daerah_banjir',$id_jalan_daerah_banjir)
                                ->orderBy('created_at', 'Desc')
                                ->get();
        // dd($this->data_penanganan);
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
        // dd($detail);
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

    public function showDetailLokasiMapsAllBase(){
        $detailDaerahBanjir = [];
        $data_kecamatan = [];
            $detailDaerahBanjir = M_jalan_daerah_banjir::select('a.*')
                                    ->from('tb_jalan_daerah_banjir as a')
                                    // ->leftJoin('tb_jalan_daerah_banjir as b','a.id_jalan_daerah_banjir','=','b.id_daerah_banjir')
                                    ->where('a.konfirmasi_st',1)
                                    ->get();
        $data = [
            'jalan_daerah_banjir' => $detailDaerahBanjir,
        ];
        $this->dispatch('render-map-all-base',$data);
    }

}
