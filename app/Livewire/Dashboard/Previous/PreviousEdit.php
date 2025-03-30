<?php

namespace App\Livewire\Dashboard\Previous;

use App\Models\PreviousMonth;
use Livewire\Attributes\On;
use Livewire\Component;

class PreviousEdit extends Component
{
    public $previousID;
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
        $previousID = PreviousMonth::find($id);

        $this->previousID  = $previousID;
        $this->total = $previousID->total;
          
        $this->dispatch('open-modal', name: 'edit-previous-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.previous.previous-edit');
    }

    public function store()
    {
        $previousID = $this->previousID;

        $validated = $this->validate([
            'total'  => ['required', 'numeric'],
        ]);

        $previousID->update($validated);

        if ($previousID) {
            $this->dispatch('previous-edited');
            $this->dispatch('close-modal', name: 'edit-previous-modal');
            $this->dispatch('alert-success', title: 'Previous Month Successfully Edited!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Edit Previous Month');
        }
    }
}
