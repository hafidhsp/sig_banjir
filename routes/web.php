<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\lokasibanjirController;

// Livewire
use App\Livewire\Landing\Index as LandingIndex;
use App\Livewire\Login\Index as LoginIndex;
use App\Livewire\Dashboard\Index as DashboardIndex;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('landing');
// });
Route::get('/',LandingIndex::class);

//login
Route::get('/login',LoginIndex::class)->name('login');
Route::get('/logout',[LoginController::class, 'logout'])->name('logout');
Route::get('/register',[LoginController::class, 'register'])->name('register');
Route::post('/auth-login',[LoginController::class, 'auth_login']);
Route::post('/actionregister',[LoginController::class, 'actionregister'])->name('actionregister');

Route::get('/dashboard',DashboardIndex::class)->name('dashboard_2');
// Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');


//lokasi banjir
Route::get('/formlokasibanjir',[lokasibanjirController::class, 'formlokasibanjir'])->name('formlokasibanjir');
Route::get('/tabellokasibanjir',[lokasibanjirController::class, 'tabellokasibanjir'])->name('tabellokasibanjir');
Route::post('/tambah_lokasi_banjir',[lokasibanjirController::class, 'store'])->name('tambah_lokasi_banjir');
Route::get('/editlokasibanjir/{id}',[lokasibanjirController::class, 'edit'])->name('editlokasibanjir');
Route::post('/updatelokasibanjir/{id}',[lokasibanjirController::class, 'update'])->name('updatelokasibanjir');
Route::delete('/hapuslokasibanjir/{id}',[lokasibanjirController::class, 'destroy'])->name('hapuslokasibanjir');
