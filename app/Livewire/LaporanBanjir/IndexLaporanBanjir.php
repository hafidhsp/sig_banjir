<?php

namespace App\Livewire\LaporanBanjir;

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

class IndexLaporanBanjir extends Component
{
    use WithFileUploads;

    public $today,$user,$title_modal,$id_daerah_banjir,$kecamatan_daerah_banjir,$nama_pemberi_informasi,$id_jalan_daerah_banjir,$nama_jalan,$nomor_jalan,$panjang_jalan,$radius,$icon,$jenis_banjir,$tinggi_banjir,$bukti_foto,$bukti_foto_info,$id_daerah_banjir_jalan,$detailNamaKecamatan,$detailPemberiInformasi,$waktu_mulai,$waktu_selesai;

    protected $listeners = ['hapusDaerahBanjir','hapusJalanDaerahBanjir'];

    public function mount(){
        $this->today = Carbon::now()->translatedFormat('d F Y');
        $this->user = Auth::user();
        $this->title_modal = 'Tambah';
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
        $this->bukti_foto_info = '';
        $this->detailNamaKecamatan = '';
        $this->detailPemberiInformasi = '';
        $this->waktu_mulai = '';
        $this->waktu_selesai = '';
        $this->resetValidation();
    }


    public function refresh_inputan(){
        $this->mount();
        $this->dispatch('render-table');
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
        $data_jalan_daerah_banjir = M_jalan_daerah_banjir::leftJoin('tb_daerah_banjir','tb_daerah_banjir.id_daerah_banjir','=','tb_daerah_banjir.id_daerah_banjir')
                                ->orderBy('tb_jalan_daerah_banjir.created_at', 'Desc')
                                ->get();
        $data_kecamatan = kecamatan::orderBy('nama_kecamatan', 'Asc')
                                    ->get();
        $title = 'Data Laporan Banjir';
        return view('livewire.laporan-banjir.index-laporan-banjir',compact('data_daerah_banjir','data_jalan_daerah_banjir','data_kecamatan','no','title_modal'))->extends('app_admin',compact('title','today','user'))->section('content');
    }

    public function save_laporan_banjir_pertama(){
       if($this->id_daerah_banjir != ''){
            $data_daerah_banjir = M_daerah_banjir::where('id_daerah_banjir',$this->id_daerah_banjir)->first();
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
        $detailDaerahBanjir = M_daerah_banjir::where('id_daerah_banjir',$id_daerah_banjir)
                                ->leftJoin('tb_kecamatan','tb_kecamatan.id_kecamatan','=','tb_daerah_banjir.id_kecamatan')
                                ->first();
        $this->id_daerah_banjir_jalan = $id_daerah_banjir;
        $this->detailNamaKecamatan = $detailDaerahBanjir->nama_kecamatan;
        $this->detailPemberiInformasi = $detailDaerahBanjir->pemberi_informasi;
        $this->dispatch('open-canvas-detail-daerah-banjir');
    }

    public function save_jalan_daerah_banjir(){
        $this->dispatch('render-canvas');

        if($this->id_jalan_daerah_banjir != ''){
            $this->validate([
                'id_jalan_daerah_banjir' => 'required|exists:tb_jalan_daerah_banjir,id_jalan_daerah_banjir',
                'nama_jalan' => 'required|regex:/^[a-zA-Z\s]+$/',
                'nomor_jalan' => 'required|numeric',
                'panjang_jalan' => 'required',
                'waktu_mulai' => 'required|date',
                'waktu_selesai' => 'date|after_or_equal:waktu_mulai',
                'radius' => 'numeric',
                'icon' => 'nullable',
                'jenis_banjir' => 'required',
                'tinggi_banjir' => 'required',
                'bukti_foto.*' => 'nullable|mimes:jpeg,jpg,png|max:2048',
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
                'jenis_banjir.required' => 'Jenis Banjir harus diisi.',
                'tinggi_banjir.required' => 'Tinggi Banjir harus diisi.',
                'bukti_foto.*.mimes' => 'Gambar harus berformat jpeg, jpg, atau png.',
                'bukti_foto.*.max' => 'Ukuran gambar maksimal 2MB.',
            ]);
            $data_jalan_daerah_banjir = M_jalan_daerah_banjir::where('id_jalan_daerah_banjir',$this->id_jalan_daerah_banjir)->first();
            $data = [
                // 'id_daerah_banjir' => $this->id_daerah_banjir_jalan,
                'nama_jalan' => $this->nama_jalan,
                'nomor_jalan' => $this->nomor_jalan,
                'panjang_jalan' => $this->panjang_jalan,
                'waktu_mulai' => $this->waktu_mulai,
                'radius' => $this->radius,
                'icon' => $this->icon,
                'jenis_banjir' => $this->jenis_banjir,
                'tinggi_banjir' => $this->tinggi_banjir,
                'konfirmasi_st' => 0,
                'created_at' => now(),
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

            $data_jalan_daerah_banjir->update($data);
            $this->mount();
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
                'jenis_banjir' => 'required',
                'tinggi_banjir' => 'required',
                'bukti_foto.*' => 'nullable|mimes:jpeg,jpg,png|max:2048',
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
                'jenis_banjir.required' => 'Jenis Banjir harus diisi.',
                'tinggi_banjir.required' => 'Tinggi Banjir harus diisi.',
                'bukti_foto.*.mimes' => 'Gambar harus berformat jpeg, jpg, atau png.',
                'bukti_foto.*.max' => 'Ukuran gambar maksimal 2MB.',
            ]);
            $data = [
                'id_daerah_banjir' => $this->id_daerah_banjir_jalan,
                'nama_jalan' => $this->nama_jalan,
                'nomor_jalan' => $this->nomor_jalan,
                'panjang_jalan' => $this->panjang_jalan,
                'waktu_mulai' => $this->waktu_mulai,
                'radius' => $this->radius,
                'icon' => $this->icon,
                'jenis_banjir' => $this->jenis_banjir,
                'tinggi_banjir' => $this->tinggi_banjir,
                'konfirmasi_st' => 0,
                'created_at' => now(),
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
            $this->mount();
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
        $this->title_modal = 'Ubah';
        $this->dispatch('open-canvas-detail-jalan-daerah-banjir');
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
}
