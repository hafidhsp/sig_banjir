<?php

namespace App\Livewire\Register;

use Livewire\Component;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class Index extends Component
{
    public $nama_lengkap, $email, $password;

    public function render()
    {
        $title='Register';
        return view('livewire.register.index')->extends('app_login',compact('title'))->section('content');
    }

    public function tambah_akun()
    {
        $this->validate([
            'nama_lengkap' => 'required|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ], [
            'nama_lengkap.regex' => 'Nama lengkap berisi huruf.',
            'nama_lengkap.required' => 'Nama lengkap harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password harus terdiri dari minimal 6 karakter.'
        ]);

        $data = [
            'nama_lengkap' => $this->nama_lengkap,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            ];

        $create = User::create($data);

        if($create){
            return redirect('login')->with('success', 'Registrasi berhasil, silahkan login.');
        } else {
            return back()->with('loginError', 'Terjadi kesalahan saat registrasi.');
        }
    }
}
