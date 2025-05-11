<?php

namespace App\Livewire\Penanganan;

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

class IndexPenanganan extends Component
{
    use WithFileUploads;

    public  $today,
            $user,
            $title_modal,
            $data_penanganan,
            $all_kecamatan,
            $id_penanganan,
            $nama_penanganan,
            $nama_petugas,
            $waktu_mulai,
            $waktu_selesai,
            $anggaran,
            $deskripsi,
            $bukti_foto_penanganan,
            $bukti_foto_penanganan_info,
            $id_jalan_daerah_banjir_penanganan_info,
            $hide_id_jalan_daerah_banjir,
            $status_penanganan,
            $idbuktiGambar,
            $buktiGambar
            ;
    public $search = '';

    protected $listeners = [
        'ShowValidationStatusPenanganan',
        'ActionUbahStatusPenanganan',
        'hapusPenanganan',
        'hapusBuktiPenanganan'
    ];

    public function mount(){
        $this->today = Carbon::now()->translatedFormat('d F Y');
        $this->user = Auth::user();
        $this->title_modal = 'Tambah';
        $this->resetValidation();
        $this->data_penanganan = [];
        $this->all_kecamatan = [];
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
        $this->buktiGambar = '';
        $this->idbuktiGambar = '';
    }

    public function refresh_page(){
        $this->mount();
        $this->dispatch('render-table');
    }

    public function render()
    {
        $today = $this->today;
        $title_modal = $this->title_modal;
        $user = $this->user;
        $no = 1 ;
        $title = 'Data Penanganan';

        $query = M_penanganan::select(
                            'tb_penanganan.*',
                            'tb_jalan_daerah_banjir.*',
                            'tb_kecamatan.nama_kecamatan',
                        )
                        ->leftJoin('tb_jalan_daerah_banjir', 'tb_jalan_daerah_banjir.id_jalan_daerah_banjir', '=', 'tb_penanganan.id_jalan_daerah_banjir')
                        ->leftJoin('tb_kecamatan', 'tb_kecamatan.id_kecamatan', '=', 'tb_jalan_daerah_banjir.id_kecamatan')
                        ->orderBy('tb_penanganan.created_at', 'desc');

        // Jika ada nilai pada search, tambahkan filter berdasarkan kecamatan
        if ($this->search) {
            $query->where('tb_jalan_daerah_banjir.id_kecamatan', 'like', '%'.$this->search.'%');
        }

        $this->data_penanganan = !empty($query->get())?$query->get():[];
        $this->all_kecamatan = kecamatan::all();
        return view('livewire.penanganan.index-penanganan',compact('title','no','title_modal'))->extends('app_admin',compact('title','today','user'))->section('content');
    }

    public function updatedSearch($value)
    {
        $this->dispatch('refresh-table');
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
        // dd($this->id_penanganan);
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
        }
        $this->dispatch('render-table');
        $this->dispatch('open-notif-success');
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

    public function show_delete_penanganan($id_penanganan){
         $this->dispatch('open-modal-validation-hapus-penanganan',['id_penanganan'=>$id_penanganan]);
    }

    public function hapusPenanganan($id_penanganan){
        $data_penanganan = M_penanganan::where('id_penanganan',$id_penanganan)->first();
        $data_penanganan->delete();
        $this->dispatch('open-notif-success-delete');
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
        // dd($id_penanganan);
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

    public function ShowValidationStatusPenanganan($id_penanganan){
        $penanganan = M_penanganan::where('id_penanganan',$id_penanganan)
                        ->first();
        $data = [
            'id_penanganan' => $id_penanganan,
            'status_penanganan' => $penanganan->status_penanganan,
        ];
        $this->dispatch('open-modal-validation-ubah-status-penanganan',$data);
    }

    public function ActionUbahStatusPenanganan($id_penanganan,$status_penanganan){
        $penanganan = M_penanganan::where('id_penanganan',$id_penanganan)
                    ->first();
        $data = [
            'status_penanganan' => $status_penanganan,
        ];
        $penanganan->update($data);
        $this->refresh_page();
        $this->dispatch('open-notif-success');
    }
}