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
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class IndexLaporanBanjir extends Component
{
    public $today,$user,$title_modal,$id_daerah_banjir,$kecamatan_daerah_banjir,$nama_pemberi_informasi;

    protected $listeners = ['hapusDaerahBanjir'];

    public function mount(){
        $this->today = Carbon::now()->translatedFormat('d F Y');
        $this->user = Auth::user();
        $this->title_modal = 'Tambah';
        $this->kecamatan_daerah_banjir = '';
        $this->nama_pemberi_informasi = '';
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
        $data_daerah_banjir = M_daerah_banjir::orderBy('tb_daerah_banjir.created_at', 'Desc')
                                ->leftJoin('tb_kecamatan','tb_kecamatan.id_kecamatan','=','tb_daerah_banjir.id_kecamatan')
                                ->get();
        $data_kecamatan = kecamatan::orderBy('nama_kecamatan', 'Asc')
                                    ->get();
        $title = 'Data Laporan Banjir';
        return view('livewire.laporan-banjir.index-laporan-banjir',compact('data_daerah_banjir','data_kecamatan','no','title_modal'))->extends('app_admin',compact('title','today','user'))->section('content');
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
}
