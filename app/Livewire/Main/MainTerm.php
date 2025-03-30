<?php

namespace App\Livewire\Main;

use App\Models\Term;
use Livewire\Component;

class MainTerm extends Component
{
    public function render()
    {
        $term = term::first();

        $data = [
            'term' => $term,
        ];

        return view('livewire.main.main-term', $data)->layout('layouts.main');
    }
}
