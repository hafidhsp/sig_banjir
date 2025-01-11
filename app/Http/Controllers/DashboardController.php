<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sejarah_banjir;

class DashboardController extends Controller
{
    public function dashboard(){
        {
            return view('pages.dashboard.dashboard');
        }
    }
    public function landing(){
        {
            $sejarah_banjir = sejarah_banjir::all();
            return view('index', compact('sejarah_banjir'));
        }
    }
}
