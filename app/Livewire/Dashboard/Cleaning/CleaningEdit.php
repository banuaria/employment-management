<?php

namespace App\Livewire\Dashboard\Cleaning;

use App\Models\Cleaning;
use Livewire\Attributes\On;
use Livewire\Component;

class CleaningEdit extends Component
{
    public $cleaningID;
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
        $cleaningID = Cleaning::find($id);

        $this->cleaningID  = $cleaningID;
        $this->total = $cleaningID->total;
          
        $this->dispatch('open-modal', name: 'edit-cleaning-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.cleaning.cleaning-edit');
    }

    public function store()
    {
        $cleaningID = $this->cleaningID;
        $validated = $this->validate([
            'total'  => ['required', 'numeric'],
        ]);

        $cleaningID->update($validated);

        if ($cleaningID) {
            $this->dispatch('cleaning-edited');
            $this->dispatch('close-modal', name: 'edit-cleaning-modal');
            $this->dispatch('alert-success', title: 'Cleaning Successfully Edited!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Edit Cleaning');
        }
    }
}
