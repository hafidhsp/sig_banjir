<?php

namespace App\Livewire\Login;

use Livewire\Component;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class Index extends Component
{
    public $email,$password;

    public function render()
    {
        $title='Masuk';
        return view('livewire.login.index')->extends('app_login',compact('title'))->section('content');
    }

    public function auth_login()
    {
       $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password harus terdiri dari minimal 6 karakter.',
        ]);

        $login = [
            'email'     => $this->email,
            'password'     => $this->password
        ];

        if (Auth::attempt($login)) {
            return redirect('/dashboard');
        }else{
            session()->flash('error', 'Email atau password salah.');
        }
    }
}
