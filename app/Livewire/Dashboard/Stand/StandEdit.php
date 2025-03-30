<?php

namespace App\Livewire\Dashboard\Stand;

use App\Models\Stand;
use Livewire\Attributes\On;
use Livewire\Component;

class StandEdit extends Component
{
    public $standID;
    public $month_year;
    public $vendor_id;
    public $employee_id;
    public $total;

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    #[On('edited')]
    public function edited($id)
    {
        $standID = Stand::find($id);

        $this->standID  = $standID;
        $this->total = $standID->total;
          
        $this->dispatch('open-modal', name: 'edit-stand-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.stand.stand-edit');
    }

    public function store()
    {
        $standID = $this->standID;
        $validated = $this->validate([
            'total'  => ['required', 'numeric'],
        ]);

        $standID->update($validated);

        if ($standID) {
            $this->dispatch('stand-edited');
            $this->dispatch('close-modal', name: 'edit-stand-modal');
            $this->dispatch('alert-success', title: 'Uang Standby Successfully Edited!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Edit Standby');
        }
    }
}
