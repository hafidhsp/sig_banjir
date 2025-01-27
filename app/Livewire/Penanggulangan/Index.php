<?php

namespace App\Livewire\Penanggulangan;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\M_penanggulangan;
use App\Models\kecamatan;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $today,$user,$id_penanggulangan,$nama_penanggulangan,$jenis_penanggulangan,$waktu_mulai,$waktu_selesai,$petugas,$kecamatan_penanggulangan,$anggaran_penanggulangan,$deskripsi_penanggulangan,$bukti_penanggulangan,$bukti_penanggulangan_info,$status_penanggulangan;

    protected $listeners = ['hapusPenanggulangan'];

    public function mount(){
        $this->today = Carbon::now()->translatedFormat('d F Y');
        $this->user = Auth::user();
        $this->title_modal = 'Tambah';
        $this->id_penanggulangan = '';
        $this->kecamatan_penanggulangan = '';
        $this->nama_penanggulangan = '';
        $this->jenis_penanggulangan = '';
        $this->waktu_mulai = '';
        $this->waktu_selesai = '';
        $this->petugas = '';
        $this->anggaran_penanggulangan = '';
        $this->deskripsi_penanggulangan = '';
        $this->bukti_penanggulangan = '';
        $this->bukti_penanggulangan_info = '';
        $this->status_penanggulangan = '';
        $this->resetValidation();
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
        $title = 'Data Penanggulangan';
        return view('livewire.penanggulangan.index',compact('data_penanggulangan','data_kecamatan','no','title_modal'))->extends('app_admin',compact('title','today','user'))->section('content');
    }

    public function refresh_inputan(){
        $this->dispatch('render-table');
        $this->mount();
    }
    public function save_penanggulangan(){
        if($this->id_penanggulangan != ''){
            $data_penanggulangan = M_penanggulangan::where('id_penanggulangan',$this->id_penanggulangan)->first();
            $this->validate([
                'id_penanggulangan' => 'exists:tb_penanggulangan,id_penanggulangan',
                'kecamatan_penanggulangan' => 'required|exists:tb_kecamatan,id_kecamatan',
                'nama_penanggulangan' => 'required|regex:/^[a-zA-Z\s]+$/',
                'jenis_penanggulangan' => 'required|regex:/^[a-zA-Z\s]+$/',
                'waktu_mulai' => 'required|date',
                'waktu_selesai' => 'date|after_or_equal:waktu_mulai',
                'petugas' => 'required|regex:/^[a-zA-Z\s]+$/',
                'anggaran_penanggulangan' => 'required|numeric',
                'deskripsi_penanggulangan' => 'regex:/^[a-zA-Z0-9\s.,!?()-]+$/',
                'bukti_penanggulangan.*' => 'nullable|mimes:jpeg,jpg,png|max:2048',
                'status_penanggulangan' => 'required|numeric',
            ], [
                'id_penanggulangan.exist' => 'Data tidak ditemukan.',
                'kecamatan_penanggulangan.required' => 'Kecamatan harus diisi.',
                'kecamatan_penanggulangan.exist' => 'Kecamatan tidak ditemukan.',
                'nama_penanggulangan.required' => 'Nama penanggulangan harus diisi.',
                'nama_penanggulangan.regex' => 'Nama penanggulangan berisi huruf.',
                'jenis_penanggulangan.required' => 'Jenis penanggulangan harus diisi.',
                'jenis_penanggulangan.regex' => 'Jenis penanggulangan berisi huruf.',
                'waktu_mulai.required' => 'Waktu mulai harus diisi.',
                'waktu_mulai.date' => 'Format tanggal tidak sesuai.',
                'waktu_selesai.date' => 'Format tanggal tidak sesuai.',
                'waktu_selesai.after_or_equal' => 'Format tanggal minimal dihari yang sama.',
                'petugas.required' => 'Petugas harus diisi.',
                'petugas.regex' => 'Petugas berisi huruf.',
                'anggaran_penanggulangan.required' => 'Anggaran harus diisi.',
                'anggaran_penanggulangan.numeric' => 'Anggaran berisi angka.',
                'deskripsi_penanggulangan.regex' => 'Format tidak sesuai.',
                'bukti_penanggulangan.*.mimes' => 'Gambar harus berformat jpeg, jpg, atau png.',
                'bukti_penanggulangan.*.max' => 'Ukuran gambar maksimal 2MB.',
                'status_penanggulangan.required' => 'Status belum dipilih.',
                'status_penanggulangan.numeric' => 'Status tidak sesuai.',
            ]);
            $data = [
                    'id_kecamatan' => $this->kecamatan_penanggulangan,
                    'nama_penanggulangan' => $this->nama_penanggulangan,
                    'jenis_penanggulangan' => $this->jenis_penanggulangan,
                    'waktu_mulai' => $this->waktu_mulai,
                    'petugas' => $this->petugas,
                    'anggaran' => $this->anggaran_penanggulangan,
                    'status_penanggulangan' => $this->status_penanggulangan,
                    'deskripsi_penanggulangan' => $this->deskripsi_penanggulangan,
                ];
            if(!empty($this->waktu_selesai)){
            $data['waktu_selesai']=$this->waktu_selesai;
            }
            if (!empty($this->bukti_penanggulangan)) {

                $existingFiles = explode('#', $data_penanggulangan->bukti_penanggulangan ?? '');

                $newFileNames = [];
                foreach ($this->bukti_penanggulangan as $file) {
                    $filePath = $file->storeAs(
                        'penanggulangan',
                        md5(uniqid() . time()) . '.' . $file->getClientOriginalExtension(),
                        'public'
                    );
                    $newFileNames[] = basename($filePath);
                }

                $allFileNames = array_merge($existingFiles, $newFileNames);

                $data['bukti_penanggulangan'] = implode('#', $allFileNames);
            }
            $data_penanggulangan->update($data);
            $this->dispatch('open-notif-success');
            $this->mount();
        }else{
            $this->validate([
                'kecamatan_penanggulangan' => 'required|exists:tb_kecamatan,id_kecamatan',
                'nama_penanggulangan' => 'required|regex:/^[a-zA-Z\s]+$/',
                'jenis_penanggulangan' => 'required|regex:/^[a-zA-Z\s]+$/',
                'waktu_mulai' => 'required|date',
                'waktu_selesai' => 'date|after_or_equal:waktu_mulai',
                'petugas' => 'required|regex:/^[a-zA-Z\s]+$/',
                'anggaran_penanggulangan' => 'required|numeric',
                'deskripsi_penanggulangan' => 'regex:/^[a-zA-Z0-9\s.,!?()-]+$/',
                'bukti_penanggulangan.*' => 'nullable|mimes:jpeg,jpg,png|max:2048',
                'status_penanggulangan' => 'required|numeric',
            ], [
                'kecamatan_penanggulangan.required' => 'Kecamatan harus diisi.',
                'kecamatan_penanggulangan.exist' => 'Kecamatan tidak ditemukan.',
                'nama_penanggulangan.required' => 'Nama penanggulangan harus diisi.',
                'nama_penanggulangan.regex' => 'Nama penanggulangan berisi huruf.',
                'jenis_penanggulangan.required' => 'Jenis penanggulangan harus diisi.',
                'jenis_penanggulangan.regex' => 'Jenis penanggulangan berisi huruf.',
                'waktu_mulai.required' => 'Waktu mulai harus diisi.',
                'waktu_mulai.date' => 'Format tanggal tidak sesuai.',
                'waktu_selesai.date' => 'Format tanggal tidak sesuai.',
                'waktu_selesai.after_or_equal' => 'Format tanggal minimal dihari yang sama.',
                'petugas.required' => 'Petugas harus diisi.',
                'petugas.regex' => 'Petugas berisi huruf.',
                'anggaran_penanggulangan.required' => 'Anggaran harus diisi.',
                'anggaran_penanggulangan.numeric' => 'Anggaran berisi angka.',
                'deskripsi_penanggulangan.regex' => 'Format tidak sesuai.',
                'bukti_penanggulangan.*.mimes' => 'Gambar harus berformat jpeg, jpg, atau png.',
                'bukti_penanggulangan.*.max' => 'Ukuran gambar maksimal 2MB.',
                'status_penanggulangan.required' => 'Status belum dipilih.',
                'status_penanggulangan.numeric' => 'Status tidak sesuai.',
            ]);
            $data = [
                    'id_kecamatan' => $this->kecamatan_penanggulangan,
                    'nama_penanggulangan' => $this->nama_penanggulangan,
                    'jenis_penanggulangan' => $this->jenis_penanggulangan,
                    'waktu_mulai' => $this->waktu_mulai,
                    'petugas' => $this->petugas,
                    'anggaran' => $this->anggaran_penanggulangan,
                    'status_penanggulangan' => $this->status_penanggulangan,
                    'deskripsi_penanggulangan' => $this->deskripsi_penanggulangan,
                ];
            if(!empty($this->waktu_selesai)){
            $data['waktu_selesai']=$this->waktu_selesai;
            }
            if (!empty($this->bukti_penanggulangan)) {
                $fileNames = [];
                foreach ($this->bukti_penanggulangan as $file) {
                    $filePath = $file->storeAs(
                        'penanggulangan',
                        md5(uniqid() . time()) . '.' . $file->getClientOriginalExtension(),
                        'public'
                    );
                    $fileNames[] = basename($filePath);
                }
                $data['bukti_penanggulangan'] = implode('#', $fileNames);
            }
            M_penanggulangan::insert($data);
            $this->mount();
            $this->dispatch('open-notif-success');
        }
    }

    public function showModalPenanggulangan($id_penanggulangan){
        $data_penanggulangan = M_penanggulangan::where('tb_penanggulangan.id_penanggulangan',$id_penanggulangan)
                                ->leftJoin('tb_kecamatan','tb_kecamatan.id_kecamatan','=','tb_penanggulangan.id_kecamatan')
                                ->first();
        $this->id_penanggulangan = $data_penanggulangan->id_penanggulangan;
        $this->kecamatan_penanggulangan = $data_penanggulangan->id_kecamatan;
        $this->nama_penanggulangan = $data_penanggulangan->nama_penanggulangan;
        $this->jenis_penanggulangan = $data_penanggulangan->jenis_penanggulangan;
        $this->waktu_mulai = $data_penanggulangan->waktu_mulai->format('Y-m-d');
        $this->waktu_selesai = !empty($data_penanggulangan->waktu_selesai)?$data_penanggulangan->waktu_selesai->format('Y-m-d'):'';
        $this->petugas = $data_penanggulangan->petugas;
        $this->anggaran_penanggulangan = $data_penanggulangan->anggaran;
        $this->status_penanggulangan = $data_penanggulangan->status_penanggulangan;
        $this->deskripsi_penanggulangan = $data_penanggulangan->deskripsi_penanggulangan;
        $this->title_modal = 'Ubah';
        $this->dispatch('updateSelectColor',$data_penanggulangan->status_penanggulangan);
        $this->dispatch('open-modal-form-penanggulangan');
    }

    public function show_delete_penanggulangan($id_penanggulangan){
         $this->dispatch('open-modal-validation-hapus-penanggulangan',$id_penanggulangan);
    }

    public function hapusPenanggulangan($id_penanggulangan){
        $data_penanggulangan = M_penanggulangan::where('id_penanggulangan',$id_penanggulangan)->first();
        $data_penanggulangan->delete();
        $this->dispatch('open-notif-success-delete');
    }

    public function showModalBuktiPenanggulangan($id_penanggulangan){
        $this->dispatch('open-modal-bukti-penanggulangan');
    }
}
