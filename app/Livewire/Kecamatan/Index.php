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
     public $today,$user,$nama_kecamatan,$id_kecamatan,$title_modal;

    protected $listeners = ['hapusKecamatan','RenderUlang'];


    public function mount(){
        $this->today = Carbon::now()->translatedFormat('d F Y');
        $this->user = Auth::user();
        $this->id_keacamatan = '';
        $this->nama_kecamatan = '';
        $this->title_modal = 'Tambah';
        $this->dispatch('close-modal-form-kecamatan');
        $this->dispatch('render-table');
    }

    public function render()
    {
        $no = 1 ;
        $user = $this->user;
        $data_kecamatan = Kecamatan::all();
        $today = $this->today;
        $title_modal = $this->title_modal;
        $title = 'Data Kecamatan';
        return view('livewire.kecamatan.index',compact('data_kecamatan','no','title_modal'))->extends('app_admin',compact('title','today','user'))->section('content');
    }

    public function showModalKecamatan($id){
        $data_kecamatan = Kecamatan::find($id);
        $this->id_kecamatan = $data_kecamatan->id;
        $this->nama_kecamatan = $data_kecamatan->nama_kecamatan;
        $this->title_modal = 'Ubah';
        $this->dispatch('open-modal-form-kecamatan');
    }
    public function closeModalKecamatan(){
        $this->mount();
    }
    public function RenderUlang(){
        $this->mount();
    }

    public function save_kecamatan(){
        if($this->id_kecamatan != ''){
            $data_kecamatan = Kecamatan::find($this->id_kecamatan);
            $this->dispatch('close-modal-form-kecamatan');
            $this->dispatch('open-modal-form-kecamatan');
             $this->validate([
                    'id_kecamatan' => 'required|exists:kecamatan,id',
                    'nama_kecamatan' => 'required|regex:/^[a-zA-Z\s]+$/',
                ], [
                    'id_kecamatan.required' => 'Data masih kosong.',
                    'id_kecamatan.exist' => 'Data tidak ditemukan.',
                    'nama_kecamatan.regex' => 'Nama Kecamatan berisi huruf.',
                    'nama_kecamatan.required' => 'Nama Kecamatan harus diisi.',
                ]);
                 $data = [
                    'nama_kecamatan' => $this->nama_kecamatan,
                ];
                $data_kecamatan->update($data);
                $this->nama_kecamatan = '';
                session()->flash('success', 'Berhasil disimpan.');
                $this->dispatch('open-notif-success');

        }else{
            $this->dispatch('close-modal-form-kecamatan');
            $this->dispatch('open-modal-form-kecamatan');
            $this->validate([
                    'nama_kecamatan' => 'required|regex:/^[a-zA-Z\s]+$/|unique:kecamatan,nama_kecamatan',
                ], [
                    'nama_kecamatan.regex' => 'Nama Kecamatan berisi huruf.',
                    'nama_kecamatan.required' => 'Nama Kecamatan harus diisi.',
                    'nama_kecamatan.unique' => 'Nama Kecamatan sudah tersedia.',
                ]);
             $data = [
                    'nama_kecamatan' => $this->nama_kecamatan,
            ];
            Kecamatan::insert($data);
            $this->mount();
            session()->flash('success', 'Berhasil disimpan.');
            $this->dispatch('open-notif-success');
        }
    }

    public function show_delete_kecamatan($id_kecamatan){
         $this->dispatch('open-modal-validation-hapus-kecamatan',$id_kecamatan);
    }

    public function hapusKecamatan($id_kecamatan){
        $data_kecamatan = Kecamatan::find($id_kecamatan);
        $data_kecamatan->delete();
        $this->dispatch('open-notif-success-delete');
    }

}
