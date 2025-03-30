<?php

namespace App\Livewire\Dashboard\Term;

use App\Models\Term;
use Livewire\Component;

class TermIndex extends Component
{
    public function render()
    {
        $term = Term::with(['updatedBy'])->first();

        $data = [
            'term' => $term,
        ];

        return view('livewire.dashboard.term.term-index', $data)->layout('layouts.dashboard', [
            'header' => 'Terms & Conditions'
        ]);
    }
}
