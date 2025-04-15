<?php

namespace App\Livewire\Dashboard\Absent;

use App\Models\AbsentMonthlies;
use Livewire\Attributes\On;
use Livewire\Component;

class AbsentEdit extends Component
{
    public $absentID;
    public $month_year;
    public $vendor_id;
    public $employee_id;
    public $absent;
    public $bonus_absent;

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    #[On('edited')]
    public function edited($id)
    {
        $absentID = AbsentMonthlies::find($id);

        $this->absentID  = $absentID;
        $this->absent = $absentID->absent;
        $this->bonus_absent = $absentID->bonus_absent;
          
        $this->dispatch('open-modal', name: 'edit-absent-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.absent.absent-edit');
    }

    public function store()
    {
        $absentID = $this->absentID;

        $validated = $this->validate([
            'absent'  => ['required', 'numeric'],
            'bonus_absent'  => ['required', 'numeric'],
        ]);

        $absentID->update($validated);

        if ($absentID) {
            $this->dispatch('absent-edited');
            $this->dispatch('close-modal', name: 'edit-absent-modal');
            $this->dispatch('alert-success', title: 'Absent Successfully Edited!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Edit Absent');
        }
    }
}
