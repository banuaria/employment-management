<?php

namespace App\Livewire\Main;

use App\Models\Cover;
use App\Models\Feature;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class MainIndex extends Component
{   

    public function mount()
    {
        return Redirect::route('login');
    }
    public function render()
    {
        // Volt::route('login', 'auth.login')
        // ->name('login');

        return view('livewire.main.main-index')->layout('layouts.main');
    }
}
