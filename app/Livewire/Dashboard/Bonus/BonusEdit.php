<?php

namespace App\Livewire\Dashboard\Bonus;

use App\Models\BonusBBM;
use Livewire\Attributes\On;
use Livewire\Component;

class BonusEdit extends Component
{
    public $bonusBBMID;
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
        $bonusBBMID = BonusBBM::find($id);

        $this->bonusBBMID  = $bonusBBMID;
        $this->total = $bonusBBMID->total;
          
        $this->dispatch('open-modal', name: 'edit-bonus-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.bonus.bonus-edit');
    }

    public function store()
    {
        $bonusBBMID = $this->bonusBBMID;
        $validated = $this->validate([
            'total'  => ['required', 'numeric'],
        ]);

        $bonusBBMID->update($validated);

        if ($bonusBBMID) {
            $this->dispatch('bonus-edited');
            $this->dispatch('close-modal', name: 'edit-bonus-modal');
            $this->dispatch('alert-success', title: 'Bonus BBM Successfully Edited!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Edit BBM Bonus');
        }
    }
}
