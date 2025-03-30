<?php

namespace App\Livewire\Dashboard\Insentif;

use App\Models\Insentif;
use Livewire\Attributes\On;
use Livewire\Component;

class InsentifEdit extends Component
{
    public $insentifID;
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
        $insentifID = Insentif::find($id);

        $this->insentifID  = $insentifID;
        $this->total = $insentifID->total;
          
        $this->dispatch('open-modal', name: 'edit-insentif-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.insentif.insentif-edit');
    }

    public function store()
    {
        $insentifID = $this->insentifID;
        $validated = $this->validate([
            'total'  => ['required', 'numeric'],
        ]);

        $insentifID->update($validated);

        if ($insentifID) {
            $this->dispatch('insentif-edited');
            $this->dispatch('close-modal', name: 'edit-insentif-modal');
            $this->dispatch('alert-success', title: 'insentif Successfully Edited!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Edit Insentif');
        }
    }
}
