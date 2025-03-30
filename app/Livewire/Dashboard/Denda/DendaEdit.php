<?php

namespace App\Livewire\Dashboard\Denda;

use App\Models\DendaSLA;
use Livewire\Attributes\On;
use Livewire\Component;

class DendaEdit extends Component
{
    public $DendaSLAID;
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
        $DendaSLAID = DendaSLA::find($id);

        $this->DendaSLAID  = $DendaSLAID;
        $this->total = $DendaSLAID->total;
          
        $this->dispatch('open-modal', name: 'edit-denda-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.denda.denda-edit');
    }

    public function store()
    {
        $makanID = $this->makanID;
        $validated = $this->validate([
            'total'  => ['required', 'numeric'],
        ]);

        $makanID->update($validated);

        if ($makanID) {
            $this->dispatch('denda-edited');
            $this->dispatch('close-modal', name: 'edit-denda-modal');
            $this->dispatch('alert-success', title: 'Denda SLA Successfully Edited!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Edit Denda SLA');
        }
    }
}
