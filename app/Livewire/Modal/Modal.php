<?php

namespace App\Livewire\Modal;

use Livewire\Component;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class Modal extends Component
{
    public $id,$email,$nama_lengkap,$password,$confirm_password;

    public function ubah_akun(){
        $this->dispatch('close-modal-user');
        $this->dispatch('open-modal-user');
        $this->validate([
            'nama_lengkap' => 'required|regex:/^[a-zA-Z\s]+$/'
        ], [
            'nama_lengkap.regex' => 'Nama lengkap berisi huruf.',
            'nama_lengkap.required' => 'Nama lengkap harus diisi.',
        ]);
        $user = User::find($this->id);
        if($user){
            if($this->password == '' && $this->confirm_password == ''){
                $data = [
                'nama_lengkap' => $this->nama_lengkap,
                ];
                 $user->update($data);
                session()->flash('success', 'Berhasil disimpan.');
            }else{
                 $this->validate([
                    'nama_lengkap' => 'required|regex:/^[a-zA-Z\s]+$/',
                    'password' => 'min:6',
                    'confirm_password' => 'same:password'
                ], [
                    'nama_lengkap.regex' => 'Nama lengkap berisi huruf.',
                    'nama_lengkap.required' => 'Nama lengkap harus diisi.',
                    'password.min' => 'Password harus terdiri dari minimal 6 karakter.',
                    'confirm_password.same' => 'Password tidak sesuai.',
                ]);
                $data = [
                'nama_lengkap' => $this->nama_lengkap,
                'password' => Hash::make($this->password),
                ];
                 $user->update($data);
                session()->flash('success', 'Berhasil disimpan.');
            }
        }else{
            session()->flash('error', 'Akun tidak ditemukan.');
        }
    }

    public function render()
    {
        $user = Auth::user();
        $this->email = $user->email;
        $this->nama_lengkap = $user->nama_lengkap;
        $this->id = $user->id;
        $this->password = '';
        $this->confirm_password = '';
        return view('livewire.modal.modal',compact('user'));
    }
}
