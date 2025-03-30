<?php

namespace App\Livewire\Main;

use App\Models\Location;
use Livewire\Component;

class MainLocation extends Component
{
    public function render()
    {
        $locations = Location::active()->orderBy('id', 'DESC')->get();

        $data = [
            'locations' => $locations,
        ];

        return view('livewire.main.main-location', $data);
    }
}
