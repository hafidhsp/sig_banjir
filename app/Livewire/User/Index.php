<?php

namespace App\Livewire\User;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class Index extends Component
{
    public $today,$user,$email_user,$nama_lengkap_user,$role_user,$id_user,$password_user,$confirm_password_user,$title_modal;

    protected $listeners = ['hapusUser'];

    public function mount(){
        $this->today = Carbon::now()->translatedFormat('d F Y');
        $this->user = Auth::user();
        $this->id_user = '';
        $this->email_user = '';
        $this->nama_lengkap_user = '';
        $this->role_user = '';
        $this->password_user = '';
        $this->confirm_password_user = '';
        $this->title_modal = 'Tambah';
    }

    public function render()
    {
        $no = 1 ;
        $user = $this->user;
        $data_user = User::orderBy('nama_lengkap', 'Asc')->get();
        $today = $this->today;
        $title_modal = $this->title_modal;
        $title = 'Data User';
        return view('livewire.user.index',compact('data_user','no','title_modal'))->extends('app_admin',compact('title','today','user'))->section('content');
    }

    public function showModalUser($id){
        $data_user = User::find($id);
        $this->id_user = $data_user->id;
        $this->email_user = $data_user->email;
        $this->nama_lengkap_user = $data_user->nama_lengkap;
        $this->role_user = $data_user->role;
        $this->title_modal = 'Ubah';
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
                    'role_user' => 'required',
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
                    'role_user' => 'required',
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
}
