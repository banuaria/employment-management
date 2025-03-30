<?php

namespace App\Livewire\Main;

use App\Models\Store;
use Livewire\Component;

class MainStore extends Component
{
    public function render()
    {
        $stores = Store::active()->get();

        $data = [
            'stores' => $stores,
        ];

        return view('livewire.main.main-store', $data)->layout('layouts.main');
    }
}
