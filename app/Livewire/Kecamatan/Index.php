<?php

namespace App\Livewire\Kecamatan;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Kecamatan;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class Index extends Component
{
    public $today,$user,$nama_kecamatan,$id_kecamatan,$long_atitude,$la_atitude,$icon,$radius,$warna_radius,$title_modal,$title_modal_user,$email_user,$nama_lengkap_user,$role_user,$id_user,$password_user,$confirm_password_user;

    protected $listeners = ['hapusKecamatan','hapusUser'];


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
        // Sesi User
        $this->id_user = '';
        $this->email_user = '';
        $this->nama_lengkap_user = '';
        $this->role_user = '';
        $this->password_user = '';
        $this->confirm_password_user = '';

        $this->title_modal = 'Tambah';
        $this->title_modal_user = 'Tambah';
        $this->resetValidation();
    }

    public function render()
    {
        $no = 1 ;
        $no_user = 1 ;
        $user = $this->user;
        $data_kecamatan = Kecamatan::orderBy('nama_kecamatan', 'ASC')->get();
        $data_user = User::orderBy('nama_lengkap', 'Asc')->get();
        $today = $this->today;
        $title_modal = $this->title_modal;
        $title = 'Master Data';
        return view('livewire.kecamatan.index',compact('data_user','data_kecamatan','no','no_user','title_modal','title'))->extends('app_admin',compact('title','today','user'))->section('content');
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
                    'long_atitude' => 'required|regex:/^-?\d+([,\.]\d+)?$/',
                    'la_atitude' => 'required|regex:/^-?\d+([,\.]\d+)?$/',
                    'icon' => 'required',
                    'radius' => 'required|numeric',
                    'warna_radius' => 'required',
                ], [
                    'id_kecamatan.required' => 'Data masih kosong.',
                    'id_kecamatan.exist' => 'Data tidak ditemukan.',
                    'nama_kecamatan.regex' => 'Nama Kecamatan berisi huruf.',
                    'nama_kecamatan.required' => 'Nama Kecamatan harus diisi.',
                    'long_atitude.required' => 'Longatitude harus diisi.',
                    'long_atitude.regex' => 'Longatitude tidak valid.',
                    'la_atitude.required' => 'Latitude harus diisi.',
                    'la_atitude.regex' => 'Latitude tidak valid.',
                    'icon.required' => 'Icon harus diisi.',
                    'radius.required' => 'Radius harus diisi.',
                    'radius.numeric' => 'radius berisi angka.',
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
                    'long_atitude' => 'required|regex:/^-?\d+([,\.]\d+)?$/',
                    'la_atitude' => 'required|regex:/^-?\d+([,\.]\d+)?$/',
                    'icon' => 'required',
                    'radius' => 'required|numeric',
                    'warna_radius' => 'required',
                ], [
                    'nama_kecamatan.regex' => 'Nama Kecamatan berisi huruf.',
                    'nama_kecamatan.required' => 'Nama Kecamatan harus diisi.',
                    'nama_kecamatan.unique' => 'Nama Kecamatan sudah tersedia.',
                    'long_atitude.required' => 'Longatitude harus diisi.',
                    'long_atitude.regex' => 'Longatitude tidak valid.',
                    'la_atitude.required' => 'Latitude harus diisi.',
                    'la_atitude.regex' => 'Latitude tidak valid.',
                    'icon.required' => 'Icon harus diisi.',
                    'radius.required' => 'Radius harus diisi.',
                    'radius.numeric' => 'radius berisi angka.',
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

    public function switchKecamatanUser($type = true){
        // dd($type);
        if($type == true){
            $this->dispatch('open-kecamatan');
        }else{
            $this->dispatch('open-user');
        }
    }

    // Start User
    public function showModalUser($id){
        $data_user = User::find($id);
        $this->id_user = $data_user->id;
        $this->email_user = $data_user->email;
        $this->nama_lengkap_user = $data_user->nama_lengkap;
        $this->role_user = $data_user->role;
        $this->title_modal_user = 'Ubah';
        $this->dispatch('open-modal-form-user');
    }

    public function save_user(){
        if($this->id_user != ''){
            $data_user = User::find($this->id_user);
            if($this->password_user == '' && $this->confirm_password_user == ''){
                $this->validate([
                    'id_user' => 'required|exists:users,id',
                    'email_user' => 'required|email',
                    'nama_lengkap_user' => 'required|regex:/^[a-zA-Z\s]+$/',
                    'role_user' => 'required|in:admin,user,kepala',
                ], [
                    'id_user.required' => 'Data masih kosong.',
                    'id_user.exist' => 'Data tidak ditemukan.',
                    'nama_lengkap_user.regex' => 'Nama lengkap berisi huruf.',
                    'nama_lengkap_user.required' => 'Nama lengkap harus diisi.',
                    'email_user.required' => 'Email harus diisi.',
                    'email_user.email' => 'Format tidak sesuai.',
                    'email_user.unique' => 'Email sudah tersedia.',
                    'role_user.required' => 'Role belum dipilih.',
                ]);
                $data = [
                    'email' => $this->email_user,
                    'nama_lengkap' => $this->nama_lengkap_user,
                    'role' => $this->role_user,
                ];
                $data_user->update($data);
                session()->flash('success', 'Berhasil disimpan.');
                $this->dispatch('open-notif-success');
            }else{
                $this->validate([
                    'id_user' => 'required|exists:users,id',
                    'email_user' => 'required|email',
                    'nama_lengkap_user' => 'required|regex:/^[a-zA-Z\s]+$/',
                    'role_user' => 'required|in:admin,user,kepala',
                    'password_user' => 'min:6',
                    'confirm_password_user' => 'same:password_user'
                ], [
                    'id_user.required' => 'Data masih kosong.',
                    'id_user.exist' => 'Data tidak ditemukan.',
                    'nama_lengkap_user.regex' => 'Nama lengkap berisi huruf.',
                    'nama_lengkap_user.required' => 'Nama lengkap harus diisi.',
                    'email_user.required' => 'Email harus diisi.',
                    'email_user.email' => 'Format tidak sesuai.',
                    'email_user.unique' => 'Email sudah tersedia.',
                    'role_user.required' => 'Role belum dipilih.',
                    'password_user.min' => 'Password harus terdiri dari minimal 6 karakter.',
                    'confirm_password_user.same' => 'Password tidak sesuai.',
                ]);
                $data = [
                    'email' => $this->email_user,
                    'nama_lengkap' => $this->nama_lengkap_user,
                    'role' => $this->role_user,
                    'password' => Hash::make($this->password_user),
                ];
                $data_user->update($data);
                $this->password_user = '';
                $this->confirm_password_user = '';
                session()->flash('success', 'Berhasil disimpan.');
                $this->mount();
                $this->dispatch('open-notif-success');
            }
        }else{
            $this->validate([
                'email_user' => 'required|email|unique:users,email',
                'nama_lengkap_user' => 'required|regex:/^[a-zA-Z\s]+$/',
                'role_user' => 'required',
                'password_user' => 'min:6',
                'confirm_password_user' => 'same:password_user'
            ], [
                'nama_lengkap_user.regex' => 'Nama lengkap berisi huruf.',
                'nama_lengkap_user.required' => 'Nama lengkap harus diisi.',
                'email_user.required' => 'Email harus diisi.',
                'email_user.email' => 'Format tidak sesuai.',
                'email_user.unique' => 'Email sudah tersedia.',
                'role_user.required' => 'Role belum dipilih.',
                'password_user.min' => 'Password harus terdiri dari minimal 6 karakter.',
                'confirm_password_user.same' => 'Password tidak sesuai.',
            ]);
            $data = [
                    'email' => $this->email_user,
                    'nama_lengkap' => $this->nama_lengkap_user,
                    'role' => $this->role_user,
                    'password' => Hash::make($this->password_user),
                ];
            User::insert($data);
            $this->mount();
            $this->dispatch('open-notif-success');
            session()->flash('success', 'Berhasil disimpan.');
        }
    }

    public function show_delete_user($id_user){
         $this->dispatch('open-modal-validation-hapus-user',$id_user);
    }

    public function hapusUser($id_user){
        $data_user = User::find($id_user);
        $data_user->delete();
        $this->dispatch('open-notif-success-delete');
    }
    // End User

    public function refresh_inputan(){
        $this->dispatch('render-table');
        $this->mount();
    }

}
