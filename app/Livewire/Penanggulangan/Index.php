<?php

namespace App\Livewire\Penanggulangan;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\M_penanggulangan;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class Index extends Component
{
    public $today,$user;

    public function mount(){
        $this->today = Carbon::now()->translatedFormat('d F Y');
        $this->user = Auth::user();
        $this->title_modal = 'Tambah';
        $this->dispatch('close-modal-form-data-penanggulangan');
        $this->dispatch('render-table');
    }

    public function render()
    {
        $no = 1 ;
        $user = $this->user;
        $data_penanggulangan = M_penanggulangan::all();
        $today = $this->today;
        $title_modal = $this->title_modal;
        $title = 'Data Penanggulangan';
        return view('livewire.penanggulangan.index',compact('data_penanggulangan','no','title_modal'))->extends('app_admin',compact('title','today','user'))->section('content');
    }
}
