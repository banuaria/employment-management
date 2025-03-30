<?php

namespace App\Livewire\Main;

use App\Models\Policy;
use Livewire\Component;

class MainPolicy extends Component
{
    public function render()
    {
        $policy = Policy::first();

        $data = [
            'policy' => $policy,
        ];

        return view('livewire.main.main-policy', $data)->layout('layouts.main');
    }
}
