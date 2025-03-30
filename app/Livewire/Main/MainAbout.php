<?php

namespace App\Livewire\Main;

use App\Models\About;
use Livewire\Component;

class MainAbout extends Component
{
    public function render()
    {
        $about = About::first();

        $data = [
            'about' => $about,
        ];

        return view('livewire.main.main-about', $data)->layout('layouts.main');
    }
}
