<?php

namespace App\Livewire\User\LaporkanDataBanjir;

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
    use WithFileUploads;


    public  $today,
            $user,
            $title,
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
            $buktiGambar
        ;

    protected $listeners = [
        'hapusDaerahBanjir',
        'hapusJalanDaerahBanjir',
        'hapusBuktiJalanDaerahBanjir',
        'gantiStatusJalanDaerahBanjir',
        'ShowValidationStatusPenanganan',
        'ActionUbahStatusPenanganan',
        'hapusPenanganan',
        'hapusBuktiPenanganan'
    ];

    public function mount()
    {
        $this->today = Carbon::now()->format('d F Y');
        $this->user = Auth::user();
        $this->title_modal = 'Tambah';
        $this->title = 'Laporkan Banjir';
        $this->kecamatan_daerah_banjir = '';
        $this->nama_pemberi_informasi = '';
        $this->id_jalan_daerah_banjir = '';
        $this->id_daerah_banjir_jalan = '';
        $this->nama_jalan = '';
        $this->nomor_jalan = '';
        $this->panjang_jalan = '';
        $this->radius = '';
        $this->icon = '';
        $this->jenis_banjir = '';
        $this->tinggi_banjir = '';
        $this->bukti_foto = [];
        $this->buktiFoto = [];
        $this->idbuktiFoto = [];
        $this->bukti_foto_info = '';
        $this->detailNamaKecamatan = '';
        $this->detailPemberiInformasi = '';
        $this->detailWaktu = '';
        $this->waktu_mulai = now()->format('Y-m-d H:i:s');
        $this->waktu_selesai = '';
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
        $this->data_jalan_daerah_banjir = [];
        $this->resetValidation();
        $this->id_penanganan = '';
        $this->nama_penanganan = '';
        $this->nama_petugas = '';
        $this->anggaran = '';
        $this->deskripsi = '';
        $this->bukti_foto_penanganan = '';
        $this->bukti_foto_penanganan_info = '';
        $this->id_jalan_daerah_banjir_penanganan_info = '';
        $this->hide_id_jalan_daerah_banjir = '';
        $this->data_penanganan = [];
        $this->status_penanganan = '';
        $this->buktiGambar = '';
        $this->idbuktiGambar = '';
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
        $title = 'Laporkan Banjir';
        $no = 1 ;
        $data_daerah_banjir = M_daerah_banjir::select(
                                    'tb_daerah_banjir.*',
                                    'tb_kecamatan.nama_kecamatan',
                                )
                                ->where('tb_daerah_banjir.id_user', '=', $user->id)
                                ->leftJoin('tb_kecamatan','tb_kecamatan.id_kecamatan','=','tb_daerah_banjir.id_kecamatan')
                                ->orderBy('tb_daerah_banjir.created_at', 'Desc')
                                ->get();
        $data_jalan_daerah_banjir =  $this->data_jalan_daerah_banjir;
        $data_kecamatan = kecamatan::orderBy('nama_kecamatan', 'Asc')
                                    ->get();
        $displayjalan = $this->displayjalan;

        return view('livewire.user.laporkan-data-banjir.index',compact('title','no','title_modal','data_daerah_banjir','data_jalan_daerah_banjir','data_kecamatan'))->extends('app_admin',compact('title','today','user'))->section('content');
    }

     //Laporan Banjir Utama
    public function save_laporan_banjir_pertama(){
       if($this->id_daerah_banjir != ''){
            $data_daerah_banjir = M_daerah_banjir::where('id_daerah_banjir',$this->id_daerah_banjir)
                                                    ->first();
        // dd($data_daerah_banjir);
            $this->validate([
                'id_daerah_banjir' => 'required|exists:tb_daerah_banjir,id_daerah_banjir',
                'kecamatan_daerah_banjir' => 'required|exists:tb_kecamatan,id_kecamatan',
                'nama_pemberi_informasi' => 'required|regex:/^[a-zA-Z\s]+$/',
            ], [
                'id_daerah_banjir.exist' => 'Data tidak ditemukan.',
                'kecamatan_daerah_banjir.required' => 'Kecamatan harus diisi.',
                'kecamatan_daerah_banjir.exist' => 'Kecamatan tidak ditemukan.',
                'nama_pemberi_informasi.required' => 'Nama pemberi informasi harus diisi.',
                'nama_pemberi_informasi.regex' => 'Nama pemberi informasi berisi huruf.',
            ]);
            $data = [
                'id_kecamatan' => $this->kecamatan_daerah_banjir,
                'pemberi_informasi' => $this->nama_pemberi_informasi,
                'batal_st' => 0,
            ];
            $data_daerah_banjir->update($data);
            $this->dispatch('open-notif-success');
            $this->mount();
        }else{
            $this->validate([
                'kecamatan_daerah_banjir' => 'required|exists:tb_kecamatan,id_kecamatan',
                'nama_pemberi_informasi' => 'required|regex:/^[a-zA-Z\s]+$/',
            ], [
                'kecamatan_daerah_banjir.required' => 'Kecamatan harus diisi.',
                'kecamatan_daerah_banjir.exist' => 'Kecamatan tidak ditemukan.',
                'nama_pemberi_informasi.required' => 'Nama pemberi informasi harus diisi.',
                'nama_pemberi_informasi.regex' => 'Nama pemberi informasi berisi huruf.',
            ]);
            $data = [
                'id_user' => Auth::user()->id,
                'id_kecamatan' => $this->kecamatan_daerah_banjir,
                'pemberi_informasi' => $this->nama_pemberi_informasi,
                'batal_st' => 0,
                'created_at' => now(),
            ];
            M_daerah_banjir::insert($data);
            $this->mount();
            $this->dispatch('open-notif-success');
        }
    }

     public function showModalLaporanBanjirPertama($id_daerah_banjir){
        $data_daerah_banjir = M_daerah_banjir::where('tb_daerah_banjir.id_daerah_banjir',$id_daerah_banjir)
                                ->leftJoin('tb_kecamatan','tb_kecamatan.id_kecamatan','=','tb_daerah_banjir.id_kecamatan')
                                ->first();
        $this->id_daerah_banjir = $data_daerah_banjir->id_daerah_banjir;
        $this->kecamatan_daerah_banjir = $data_daerah_banjir->id_kecamatan;
        $this->nama_pemberi_informasi = $data_daerah_banjir->pemberi_informasi;
        $this->title_modal = 'Ubah';
        $this->dispatch('open-modal-form-daerah-banjir');
    }

    public function show_delete_daerah_banjir($id_daerah_banjir){
        $this->dispatch('open-modal-validation-hapus-daerah-banjir',$id_daerah_banjir);
    }

    public function hapusDaerahBanjir($id_daerah_banjir){
        $data_daerah_banjir = M_daerah_banjir::where('id_daerah_banjir',$id_daerah_banjir)->first();
        $data_daerah_banjir->delete();
        $this->dispatch('open-notif-success-delete');
        $this->dispatch('render-table');
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

      // Laporan Jalan daerah banjir alias Sub Daerah Banjir
    public function save_jalan_daerah_banjir(){
        $this->dispatch('render-canvas');

        if($this->id_jalan_daerah_banjir != ''){
            $this->validate([
                // 'id_jalan_daerah_banjir' => 'required|exists:tb_jalan_daerah_banjir,id_jalan_daerah_banjir',
                'nama_jalan' => 'required|regex:/^[a-zA-Z\s]+$/',
                'nomor_jalan' => 'required|numeric',
                'panjang_jalan' => 'required',
                'waktu_mulai' => 'required|date',
                'waktu_selesai' => 'date|after_or_equal:waktu_mulai',
                'radius' => 'numeric',
                'icon' => 'nullable',
                // 'jenis_banjir' => 'required',
                'tinggi_banjir' => 'required',
                'bukti_foto.*' => 'nullable|mimes:jpeg,jpg,png|max:2048',
                'long_atitude' => 'required|regex:/^-?\d+([,\.]\d+)?$/',
                'la_atitude' => 'required|regex:/^-?\d+([,\.]\d+)?$/',
                'warna_radius' => 'required',
            ], [
                'nama_jalan.required' => 'Nama Jalan harus diisi.',
                'nama_jalan.regex' => 'Nama jalan berisi huruf.',
                'nomor_jalan.required' => 'Nomor jalan harus diisi.',
                'nomor_jalan.numeric' => 'Nomor jalan berisi angka.',
                'panjang_jalan.required' => 'Panjang jalan harus diisi.',
                'waktu_mulai.required' => 'Waktu mulai harus diisi.',
                'waktu_mulai.date' => 'Format tanggal tidak sesuai.',
                'waktu_selesai.date' => 'Format tanggal tidak sesuai.',
                'waktu_selesai.after_or_equal' => 'Format tanggal minimal dihari yang sama.',
                'radius.numeric' => 'Radius berisi angka.',
                // 'jenis_banjir.required' => 'Jenis Banjir harus diisi.',
                'tinggi_banjir.required' => 'Tinggi Banjir harus diisi.',
                'bukti_foto.*.mimes' => 'Gambar harus berformat jpeg, jpg, atau png.',
                'bukti_foto.*.max' => 'Ukuran gambar maksimal 2MB.',
                'long_atitude.required' => 'Longatitude harus diisi.',
                'long_atitude.regex' => 'Longatitude tidak valid.',
                'la_atitude.required' => 'Latitude harus diisi.',
                'la_atitude.regex' => 'Latitude tidak valid.',
                'warna_radius.required' => 'Warna Radius harus diisi.',
            ]);
            $data_jalan_daerah_banjir = M_jalan_daerah_banjir::where('id_jalan_daerah_banjir',$this->id_jalan_daerah_banjir)->first();
            // $data = [
            //     'id_daerah_banjir' => $this->id_daerah_banjir_jalan,
            //     'nama_jalan' => $this->nama_jalan,
            //     'nomor_jalan' => $this->nomor_jalan,
            //     'panjang_jalan' => $this->panjang_jalan,
            //     'waktu_mulai' => $this->waktu_mulai,
            //     'radius' => $this->radius,
            //     'icon' => $this->icon,
            //     // 'jenis_banjir' => $this->jenis_banjir,
            //     'tinggi_banjir' => $this->tinggi_banjir,
            //     'konfirmasi_st' => 0,
            //     'created_at' => now(),
            //     'long_atitude' => $this->long_atitude,
            //     'la_atitude' => $this->la_atitude,
            //     'warna_radius' => $this->warna_radius,
            // ];
            $data = [
                'id_daerah_banjir' => $this->id_daerah_banjir_jalan,
                'nama_jalan' => $this->nama_jalan,
                'nomor_jalan' => $this->nomor_jalan,
                'panjang_jalan' => $this->panjang_jalan,
                'waktu_mulai' => $this->waktu_mulai,
                'radius' => $this->radius,
                'icon' => $this->icon,
                // 'jenis_banjir' => $this->jenis_banjir,
                'tinggi_banjir' => $this->tinggi_banjir,
                'konfirmasi_st' => 0,
                'created_at' => now(),
                'long_atitude' => $this->long_atitude,
                'la_atitude' => $this->la_atitude,
                'warna_radius' => $this->warna_radius,
            ];
            if(!empty($this->waktu_selesai)){
                $data['waktu_selesai']=$this->waktu_selesai;
            }
            if (!empty($this->bukti_foto)) {
                $existingFiles = [];
                if($data_jalan_daerah_banjir->bukti_foto !=''){
                    $existingFiles = explode('#', $data_jalan_daerah_banjir->bukti_foto ?? '');
                }

                $newFileNames = [];
                foreach ($this->bukti_foto as $file) {
                    $filePath = $file->storeAs(
                        'jalanbanjir',
                        md5(uniqid() . time()) . '.' . $file->getClientOriginalExtension(),
                        'asset'
                    );
                    $newFileNames[] = basename($filePath);
                }
                $allFileNames = array_merge($existingFiles, $newFileNames);
                $data['bukti_foto'] = !empty($allFileNames) ? implode('#', $allFileNames) : '';
            }
            // dd($data);
            $data_jalan_daerah_banjir->update($data);
            $this->refresh_canvas(true);
            $this->dispatch('open-notif-success-canvas-form');
        }else{
            $this->validate([
                'nama_jalan' => 'required|regex:/^[a-zA-Z\s]+$/',
                'nomor_jalan' => 'required|numeric',
                'panjang_jalan' => 'required',
                'waktu_mulai' => 'required|date',
                'waktu_selesai' => 'date|after_or_equal:waktu_mulai',
                'radius' => 'numeric',
                'icon' => 'nullable',
                // 'jenis_banjir' => 'required',
                'tinggi_banjir' => 'required',
                'bukti_foto.*' => 'nullable|mimes:jpeg,jpg,png|max:2048',
                'long_atitude' => 'required|regex:/^-?\d+([,\.]\d+)?$/',
                'la_atitude' => 'required|regex:/^-?\d+([,\.]\d+)?$/',
                'warna_radius' => 'required',
            ], [
                'nama_jalan.required' => 'Nama Jalan harus diisi.',
                'nama_jalan.regex' => 'Nama jalan berisi huruf.',
                'nomor_jalan.required' => 'Nomor jalan harus diisi.',
                'nomor_jalan.numeric' => 'Nomor jalan berisi angka.',
                'panjang_jalan.required' => 'Panjang jalan harus diisi.',
                'waktu_mulai.required' => 'Waktu mulai harus diisi.',
                'waktu_mulai.date' => 'Format tanggal tidak sesuai.',
                'waktu_selesai.date' => 'Format tanggal tidak sesuai.',
                'waktu_selesai.after_or_equal' => 'Format tanggal minimal dihari yang sama.',
                'radius.numeric' => 'Radius berisi angka.',
                // 'jenis_banjir.required' => 'Jenis Banjir harus diisi.',
                'tinggi_banjir.required' => 'Tinggi Banjir harus diisi.',
                'bukti_foto.*.mimes' => 'Gambar harus berformat jpeg, jpg, atau png.',
                'bukti_foto.*.max' => 'Ukuran gambar maksimal 2MB.',
                'long_atitude.required' => 'Longatitude harus diisi.',
                'long_atitude.regex' => 'Longatitude tidak valid.',
                'la_atitude.required' => 'Latitude harus diisi.',
                'la_atitude.regex' => 'Latitude tidak valid.',
                'warna_radius.required' => 'Warna Radius harus diisi.',
            ]);
            $data = [
                'id_daerah_banjir' => $this->id_daerah_banjir_jalan,
                'nama_jalan' => $this->nama_jalan,
                'nomor_jalan' => $this->nomor_jalan,
                'panjang_jalan' => $this->panjang_jalan,
                'waktu_mulai' => $this->waktu_mulai,
                'radius' => $this->radius,
                'icon' => $this->icon,
                // 'jenis_banjir' => $this->jenis_banjir,
                'tinggi_banjir' => $this->tinggi_banjir,
                'konfirmasi_st' => 0,
                'created_at' => now(),
                'long_atitude' => $this->long_atitude,
                'la_atitude' => $this->la_atitude,
                'warna_radius' => $this->warna_radius,
            ];
            if(!empty($this->waktu_selesai)){
                $data['waktu_selesai']=$this->waktu_selesai;
            }
            if (!empty($this->bukti_foto)) {
                $fileNames = [];
                foreach ($this->bukti_foto as $file) {
                    $filePath = $file->storeAs(
                        'jalanbanjir',
                        md5(uniqid() . time()) . '.' . $file->getClientOriginalExtension(),
                        'asset'
                    );
                    $fileNames[] = basename($filePath);
                }
                $data['bukti_foto'] = implode('#', $fileNames);
            }

            M_jalan_daerah_banjir::insert($data);
            $this->refresh_canvas(true);
            $this->dispatch('open-notif-success-canvas-form');
        }
    }

    public function showFormJalanDaerahBanjir($id_jalan_daerah_banjir){
        $detailJalanDaerahBanjir = M_jalan_daerah_banjir::where('id_jalan_daerah_banjir',$id_jalan_daerah_banjir)
                                ->first();
        $this->id_jalan_daerah_banjir = $detailJalanDaerahBanjir->id_jalan_daerah_banjir;
        $this->nama_jalan = $detailJalanDaerahBanjir->nama_jalan;
        $this->nomor_jalan = $detailJalanDaerahBanjir->nomor_jalan;
        $this->panjang_jalan = $detailJalanDaerahBanjir->panjang_jalan;
        $this->waktu_mulai = $detailJalanDaerahBanjir->waktu_mulai->format('Y-m-d');
        $this->waktu_selesai = !empty($detailJalanDaerahBanjir->waktu_selesai)?$detailJalanDaerahBanjir->waktu_selesai->format('Y-m-d'):'';
        $this->radius = $detailJalanDaerahBanjir->radius;
        $this->icon = $detailJalanDaerahBanjir->icon;
        $this->jenis_banjir = $detailJalanDaerahBanjir->jenis_banjir;
        $this->tinggi_banjir = $detailJalanDaerahBanjir->tinggi_banjir;
        $this->warna_radius = $detailJalanDaerahBanjir->warna_radius;
        $this->long_atitude = $detailJalanDaerahBanjir->long_atitude;
        $this->la_atitude = $detailJalanDaerahBanjir->la_atitude;
        $this->title_modal = 'Ubah';
        $this->dispatch('updateSelectColor',$detailJalanDaerahBanjir->warna_radius);
        $this->dispatch('open-canvas-form-jalan-daerah-banjir');
    }

    public function updatedBuktiFoto()
    {
        sleep(3);
        $this->dispatch('render-canvas');
        $this->validate([
            'bukti_foto.*' => 'nullable|mimes:jpeg,jpg,png|max:2048',
        ],[
            'bukti_foto.*.mimes' => 'Gambar harus berformat jpeg, jpg, atau png.',
            'bukti_foto.*.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

    }

    public function show_delete_jalan_daerah_banjir($id_jalan_daerah_banjir){
         $this->dispatch('open-modal-validation-hapus-jalan-daerah-banjir',$id_jalan_daerah_banjir);
    }

    public function hapusJalanDaerahBanjir($id_jalan_daerah_banjir){
        $data__jalan_daerah_banjir = M_jalan_daerah_banjir::where('id_jalan_daerah_banjir',$id_jalan_daerah_banjir)->first();
        $data__jalan_daerah_banjir->delete();
        $this->dispatch('render-table');
        $this->dispatch('open-notif-success-delete-canvas-form');
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

    public function show_delete_bukti_jalan_daerah_banjir($id_jalan_daerah_banjir,$namaFile){
         $this->dispatch('open-modal-validation-hapus-foto-jalan-daerah-banjir',['id_jalan_daerah_banjir'=>$id_jalan_daerah_banjir,'namaFile'=>$namaFile]);
    }

    public function hapusBuktiJalanDaerahBanjir($id_jalan_daerah_banjir,$namaFile){
        $data_jalan_daerah_banjir = M_jalan_daerah_banjir::where('id_jalan_daerah_banjir',$id_jalan_daerah_banjir)->first();
        $listGambar = explode('#', $data_jalan_daerah_banjir->bukti_foto ?? '');
        $index = array_search($namaFile, $listGambar);
        if ($index !== false) {
            unset($listGambar[$index]);

            $filePath = 'jalanbanjir/'.$namaFile;
            if (Storage::disk('asset')->exists($filePath)) {
                Storage::disk('asset')->delete($filePath);
            }
            $updatedList = implode('#', $listGambar);
            $data_jalan_daerah_banjir->update(['bukti_foto' => $updatedList]);
            $this->dispatch('open-notif-success-delete-canvas-detail-jalan-daerah-banjir');
        }
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

    public function showKonfirmasiJalanDaerahBanjir($id_jalan_daerah_banjir = null){
        $this->dispatch('open-modal-validation-ganti-status-jalan-daerah-banjir',$id_jalan_daerah_banjir);
    }

    // Data Penanganan
    public function updatedBuktiFotoPenanganan()
    {
        sleep(3);
        try {
            $this->validate([
                'bukti_foto_penanganan.*' => 'nullable|mimes:jpeg,jpg,png|max:2048',
            ],[
                'bukti_foto_penanganan.*.mimes' => 'Gambar harus berformat jpeg, jpg, atau png.',
                'bukti_foto_penanganan.*.max' => 'Ukuran gambar maksimal 2MB.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->reset('bukti_foto_penanganan');
            $this->reset('bukti_foto_penanganan_info');
            throw $e;
        }
    }

    public function save_penanganan(){
        $this->validate([
            'nama_penanganan' => 'required|regex:/^[a-zA-Z\s]+$/',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'date|after_or_equal:waktu_mulai|nullable',
            'nama_petugas' => 'required|regex:/^[a-zA-Z\s]+$/',
            'anggaran' => 'numeric',
            'deskripsi' => 'nullable',
        ], [
            'nama_penanganan.required' => 'Nama Penanganan harus diisi.',
            'nama_penanganan.regex' => 'Nama Penanganan berisi huruf.',
            'waktu_mulai.required' => 'Waktu mulai harus diisi.',
            'waktu_mulai.date' => 'Format tanggal tidak sesuai.',
            'waktu_selesai.date' => 'Format tanggal tidak sesuai.',
            'waktu_selesai.after_or_equal' => 'Format tanggal minimal dihari yang sama.',
            'nama_petugas.required' => 'Nama Petugas harus diisi.',
            'nama_petugas.regex' => 'Nama Petugas berisi huruf.',
            'anggaran.numeric' => 'Anggaran berisi angka.',
        ]);
            $data = [
                'id_jalan_daerah_banjir' => $this->hide_id_jalan_daerah_banjir,
                'nama_penanganan' => $this->nama_penanganan,
                'waktu_mulai' => $this->waktu_mulai,
                'petugas' => $this->nama_petugas,
                'anggaran' => $this->anggaran,
                'deskripsi_penanganan' => $this->deskripsi,
                'status_penanganan' => 0,
                'konfirmasi_st' => 0,
                'created_at' => now(),
            ];
            if(!empty($this->waktu_selesai)){
                $data['waktu_selesai']=$this->waktu_selesai;
            }
        if($this->id_penanganan != ''){
            $data_penanganan = M_penanganan::where('id_penanganan',$this->id_penanganan)->first();
            if (!empty($this->bukti_foto_penanganan)) {
                $existingFiles = [];
                if($data_penanganan->bukti_penanganan !=''){
                    $existingFiles = explode('#', $data_penanganan->bukti_penanganan ?? '');
                }

                $newFileNames = [];
                foreach ($this->bukti_foto_penanganan as $file) {
                    $filePath = $file->storeAs(
                        'penanganan',
                        md5(uniqid() . time()) . '.' . $file->getClientOriginalExtension(),
                        'asset'
                    );
                    $newFileNames[] = basename($filePath);
                }
                $allFileNames = array_merge($existingFiles, $newFileNames);
                $data['bukti_penanganan'] = !empty($allFileNames) ? implode('#', $allFileNames) : '';
            }
            // dd($data['bukti_penanganan']);
            $data_penanganan->update($data);
        }else{
            if (!empty($this->bukti_foto_penanganan)) {
                $fileNames = [];
                foreach ($this->bukti_foto_penanganan as $file) {
                    $filePath = $file->storeAs(
                        'penanganan',
                        md5(uniqid() . time()) . '.' . $file->getClientOriginalExtension(),
                        'asset'
                    );
                    $fileNames[] = basename($filePath);
                }
                $data['bukti_penanganan'] = implode('#', $fileNames);
            }
            // dd($data);
            M_penanganan::insert($data);
            // $this->mount();
            // $this->dispatch('hide-canvas-all');
        }
        $this->dispatch('open-notif-success-canvas-form');
        $this->dispatch('render-table');
        $this->refresh_canvas(false);
    }

    public function show_delete_penanganan($id_penanganan){
         $this->dispatch('open-modal-validation-hapus-penanganan',['id_penanganan'=>$id_penanganan]);
    }

    public function hapusPenanganan($id_penanganan){
        $data_penanganan = M_penanganan::where('id_penanganan',$id_penanganan)->first();
        $data_penanganan->delete();
    }

    public function showFormEditPenanganan($id_penanganan){
        $detailPenanganan = M_penanganan::where('id_penanganan',$id_penanganan)
                                ->first();
        $this->id_penanganan = $id_penanganan;
        $this->nama_penanganan = $detailPenanganan->nama_penanganan;
        $this->waktu_mulai = $detailPenanganan->waktu_mulai;
        $this->waktu_selesai = !empty($detailPenanganan->waktu_selesai)?$detailPenanganan->waktu_selesai->format('Y-m-d'):'';
        $this->nama_petugas = $detailPenanganan->petugas;
        $this->anggaran = $detailPenanganan->anggaran;
        $this->deskripsi = $detailPenanganan->deskripsi_penanganan;
        $this->title_modal = 'Ubah';
        $this->dispatch('open-modal-form-penanganan');
    }

    public function showModalBuktiPenanganan($id_penanganan){
        $data_penanganan = M_penanganan::where('id_penanganan',$id_penanganan)->first();
            if (!empty($data_penanganan->bukti_penanganan)) {
                $this->buktiGambar = explode('#', $data_penanganan->bukti_penanganan ?? '');
                $this->idbuktiGambar = $id_penanganan;
            }
        $this->dispatch('open-modal-bukti-penanganan');
    }

    public function show_delete_bukti_penanganan($id_penanganan,$namaFile){
         $this->dispatch('open-modal-validation-hapus-gambar-penanganan',['id_penanganan'=>$id_penanganan,'namaFile'=>$namaFile]);
    }

    public function hapusBuktiPenanganan($id_penanganan,$namaFile){
        $data_penanganan = M_penanganan::where('id_penanganan',$id_penanganan)->first();
        $listGambar = explode('#', $data_penanganan->bukti_penanganan ?? '');
        $index = array_search($namaFile, $listGambar);
        if ($index !== false) {
            unset($listGambar[$index]);

            $filePath = 'penanganan/'.$namaFile;
            if (Storage::disk('asset')->exists($filePath)) {
                Storage::disk('asset')->delete($filePath);
            }
            $updatedList = implode('#', $listGambar);
            $data_penanganan->update(['bukti_penanganan' => $updatedList]);

            $this->dispatch('open-notif-success-delete');
            $this->dispatch('hide-canvas-all');
        }
    }

}
