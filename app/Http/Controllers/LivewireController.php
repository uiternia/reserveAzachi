<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LivewireController extends Controller
{
    public function index(){
        return view('livewire-test.index');
    }

    public function register()
    {
        return view('livewire-test.register');
    }
}
