<?php

namespace App\Livewire\Dashboard\Profile;

use Livewire\Component;

class ProfileIndex extends Component
{
    public function render()
    {
        return view('livewire.dashboard.profile.profile-index')->layout('layouts.dashboard', [
            'header' => 'Profile Page'
        ]);
    }
}
