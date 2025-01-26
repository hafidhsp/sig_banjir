<?php

namespace App\Livewire\Kecamatan;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Kecamatan;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class Index extends Component
{
    public $today,$user,$nama_kecamatan,$id_kecamatan,$long_atitude,$la_atitude,$icon,$radius,$warna_radius,$title_modal;

    protected $listeners = ['hapusKecamatan'];


    public function mount(){
        $this->today = Carbon::now()->translatedFormat('d F Y');
        $this->user = Auth::user();
        $this->id_keacamatan = '';
        $this->nama_kecamatan = '';
        $this->long_atitude = '';
        $this->la_atitude = '';
        $this->icon = '';
        $this->radius = '';
        $this->warna_radius = '';
        $this->title_modal = 'Tambah';
        $this->resetValidation();
    }

    public function render()
    {
        $no = 1 ;
        $user = $this->user;
        $data_kecamatan = Kecamatan::orderBy('nama_kecamatan', 'ASC')->get();
        $today = $this->today;
        $title_modal = $this->title_modal;
        $title = 'Data Kecamatan';
        return view('livewire.kecamatan.index',compact('data_kecamatan','no','title_modal'))->extends('app_admin',compact('title','today','user'))->section('content');
    }

    public function showModalKecamatan($id_kecamatan){
        $data_kecamatan = Kecamatan::where('id_kecamatan',$id_kecamatan)->first();
        $this->id_kecamatan = $data_kecamatan->id_kecamatan;
        $this->nama_kecamatan = $data_kecamatan->nama_kecamatan;
        $this->long_atitude = $data_kecamatan->long_atitude;
        $this->la_atitude = $data_kecamatan->la_atitude;
        $this->icon = $data_kecamatan->icon;
        $this->radius = $data_kecamatan->radius;
        $this->warna_radius = $data_kecamatan->warna_radius;
        $this->title_modal = 'Ubah';
        $this->dispatch('updateSelectColor',$data_kecamatan->warna_radius);
        $this->dispatch('open-modal-form-kecamatan');
    }

    public function save_kecamatan(){
        if($this->id_kecamatan != ''){
            $data_kecamatan = Kecamatan::where('id_kecamatan',$this->id_kecamatan)->first();
            $this->validate([
                    'id_kecamatan' => 'required|exists:tb_kecamatan,id_kecamatan',
                    'nama_kecamatan' => 'required|regex:/^[a-zA-Z\s]+$/',
                    'long_atitude' => 'required|numeric',
                    'la_atitude' => 'required|numeric',
                    'icon' => 'required',
                    'radius' => 'required',
                    'warna_radius' => 'required',
                ], [
                    'id_kecamatan.required' => 'Data masih kosong.',
                    'id_kecamatan.exist' => 'Data tidak ditemukan.',
                    'nama_kecamatan.regex' => 'Nama Kecamatan berisi huruf.',
                    'nama_kecamatan.required' => 'Nama Kecamatan harus diisi.',
                    'long_atitude.required' => 'Longatitude harus diisi.',
                    'long_atitude.numeric' => 'Longatitude berisi angka.',
                    'la_atitude.required' => 'Latitude harus diisi.',
                    'la_atitude.numeric' => 'Latitude berisi angka.',
                    'icon.required' => 'Icon harus diisi.',
                    'radius.required' => 'Radius harus diisi.',
                    'warna_radius.required' => 'Warna Radius harus diisi.',
                ]);
                 $data = [
                    'nama_kecamatan' => $this->nama_kecamatan,
                    'long_atitude' => $this->long_atitude,
                    'la_atitude' => $this->la_atitude,
                    'icon' => $this->icon,
                    'radius' => $this->radius,
                    'warna_radius' => $this->warna_radius,
                ];
                $data_kecamatan->update($data);
                $this->nama_kecamatan = '';
                $this->dispatch('open-notif-success');
            $this->mount();
        }else{
            $this->validate([
                    'nama_kecamatan' => 'required|regex:/^[a-zA-Z\s]+$/|unique:tb_kecamatan,nama_kecamatan',
                    'long_atitude' => 'required',
                    'la_atitude' => 'required',
                    'icon' => 'required',
                    'radius' => 'required',
                    'warna_radius' => 'required',
                ], [
                    'nama_kecamatan.regex' => 'Nama Kecamatan berisi huruf.',
                    'nama_kecamatan.required' => 'Nama Kecamatan harus diisi.',
                    'nama_kecamatan.unique' => 'Nama Kecamatan sudah tersedia.',
                    'long_atitude.required' => 'Longatitude harus diisi.',
                    'la_atitude.required' => 'Latitude harus diisi.',
                    'icon.required' => 'Icon harus diisi.',
                    'radius.required' => 'Radius harus diisi.',
                    'warna_radius.required' => 'Warna Radius harus diisi.',
                ]);
             $data = [
                    'nama_kecamatan' => $this->nama_kecamatan,
                    'long_atitude' => $this->long_atitude,
                    'la_atitude' => $this->la_atitude,
                    'icon' => $this->icon,
                    'radius' => $this->radius,
                    'warna_radius' => $this->warna_radius,
            ];
            Kecamatan::insert($data);
            $this->mount();
            $this->dispatch('open-notif-success');
        }
    }

    public function show_delete_kecamatan($id_kecamatan){
         $this->dispatch('open-modal-validation-hapus-kecamatan',$id_kecamatan);
    }

    public function hapusKecamatan($id_kecamatan){
        $data_kecamatan = Kecamatan::where('id_kecamatan',$id_kecamatan)->first();
        $data_kecamatan->delete();
        $this->dispatch('open-notif-success-delete');
    }

    public function refresh_inputan(){
        $this->dispatch('render-table');
        $this->mount();
    }

}
