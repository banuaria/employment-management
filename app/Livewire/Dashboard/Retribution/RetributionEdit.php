<?php

namespace App\Livewire\Dashboard\Retribution;

use App\Models\Retribution;
use Livewire\Attributes\On;
use Livewire\Component;

class RetributionEdit extends Component
{
    public $retributionID;
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
        $retributionID = Retribution::find($id);
        $this->retributionID  = $retributionID;
        $this->total = $retributionID->total;
          
        $this->dispatch('open-modal', name: 'edit-retribution-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.retribution.retribution-edit');
    }

    public function store()
    {
        $retributionID = $this->retributionID;
        $validated = $this->validate([
            'total'  => ['required', 'numeric'],
        ]);

        $retributionID->update($validated);

        if ($retributionID) {
            $this->dispatch('retribution-edited');
            $this->dispatch('close-modal', name: 'edit-retribution-modal');
            $this->dispatch('alert-success', title: 'retribution Successfully Edited!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Edit retribution');
        }
    }
}
