<?php

namespace App\Livewire\Login;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.login.index')->extends('app_login')->section('content');
    }
}