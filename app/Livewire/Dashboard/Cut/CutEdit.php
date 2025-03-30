<?php

namespace App\Livewire\Dashboard\Cut;

use App\Models\CutSalary;
use Livewire\Attributes\On;
use Livewire\Component;

class CutEdit extends Component
{
    public $cutSalaryID;
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
        $cutSalaryID = CutSalary::find($id);

        $this->cutSalaryID  = $cutSalaryID;
        $this->total = $cutSalaryID->total;
          
        $this->dispatch('open-modal', name: 'edit-cut-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.cut.cut-edit');
    }

    public function store()
    {
        $cutSalaryID = $this->cutSalaryID;
        $validated = $this->validate([
            'total'  => ['required', 'numeric'],
        ]);

        $cutSalaryID->update($validated);

        if ($cutSalaryID) {
            $this->dispatch('cut-edited');
            $this->dispatch('close-modal', name: 'edit-cut-modal');
            $this->dispatch('alert-success', title: 'Cut Salary Successfully Edited!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Edit Cut Salary');
        }
    }
}
