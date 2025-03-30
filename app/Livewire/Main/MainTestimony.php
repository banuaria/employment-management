<?php

namespace App\Livewire\Main;

use App\Models\Testimony;
use Livewire\Component;

class MainTestimony extends Component
{
    public function render()
    {
        $testimonies = Testimony::active()->orderBy('id', 'DESC')->get();

        $data = [
            'testimonies' => $testimonies,
        ];

        return view('livewire.main.main-testimony', $data);
    }
}
