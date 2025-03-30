<?php

namespace App\Livewire\Dashboard\Config;

use App\Models\Config;
use Livewire\Attributes\On;
use Livewire\Component;

class ConfigIndex extends Component
{
    public function render()
    {
        $config = Config::first();

        $data = [
            'config' => $config,
        ];

        return view('livewire.dashboard.config.config-index', $data)->layout('layouts.dashboard', [
            'header' => 'Configs'
        ]);
    }
}
