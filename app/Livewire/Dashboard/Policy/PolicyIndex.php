<?php

namespace App\Livewire\Dashboard\Policy;

use App\Models\Policy;
use Livewire\Component;

class PolicyIndex extends Component
{
    public function render()
    {
        $policy = Policy::with(['updatedBy'])->first();

        $data = [
            'policy' => $policy,
        ];

        return view('livewire.dashboard.policy.policy-index', $data)->layout('layouts.dashboard', [
            'header' => 'Privacy Policy'
        ]);
    }
}
