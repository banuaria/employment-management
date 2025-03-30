<?php

namespace App\Livewire\Dashboard\About;

use App\Models\About;
use Livewire\Component;

class AboutIndex extends Component
{
    public function render()
    {
        $about = About::with(['updatedBy'])->first();
       
        $data = [
            'about' => $about,
        ];

        return view('livewire.dashboard.about.about-index', $data)->layout('layouts.dashboard', [
            'header' => 'About'
        ]);
    }
}
