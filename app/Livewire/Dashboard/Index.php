<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $today,$user,$show_modal_user=false;

    protected $listeners = ['modal_user' => 'open_modal_user'];

    public function mount(){
        $this->today = Carbon::now()->translatedFormat('d F Y');
        $this->user = Auth::user();
    }

    public function render()
    {
        $today = $this->today;
        $user = $this->user;
        $title = 'Dashboard';
        return view('livewire.dashboard.index')->extends('app_admin',compact('title','today','user'))->section('content');
    }
}
