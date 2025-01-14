<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //
    public function index(){
        return view ("pages.login.login");
    }
    public function auth_login(Request $request)
    {
    $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);

    $login = [
        'email'     => $request->email,
        'password'     => $request->password
    ];

    if (Auth::attempt($login)) {
        // Jika autentikasi berhasil
        return redirect('dashboard'); // Ganti dengan halaman yang ingin diredirect setelah login berhasil
    }else{
    return redirect()->route('login');
    }
}

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function register()
    {
        return view('pages.register.register');
    }

    public function create(array $data)
    {
        return User::create([
            'nama_lengkap' => $data['nama_lengkap'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function actionregister(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'email' => ['required','email','unique:users,email'],
            'password' => 'required|min:6'
        ]);

        $data['nama_lengkap']       = $request->nama_lengkap;
        $data['email']       = $request->email;
        $data['password']       = Hash::make($request->password);

        User::create($data);

        $infodaftar = [
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($infodaftar)){
            return redirect('login');
        } else {
            return back()->with('loginError', 'Terjadi kesalahan saat registrasi.');
    }
    }
}