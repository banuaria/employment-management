<?php

namespace App\Livewire\Dashboard\Lembur;

use App\Models\Lembur;
use Livewire\Attributes\On;
use Livewire\Component;

class LemburEdit extends Component
{
    public $lemburID;
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
        $lemburID = Lembur::find($id);

        $this->lemburID  = $lemburID;
        $this->total = $lemburID->total;
          
        $this->dispatch('open-modal', name: 'edit-lembur-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.lembur.lembur-edit');
    }

    public function store()
    {
        $lemburID = $this->lemburID;

        $validated = $this->validate([
            'total'  => ['required', 'numeric'],
        ]);

        $lemburID->update($validated);

        if ($lemburID) {
            $this->dispatch('lembur-edited');
            $this->dispatch('close-modal', name: 'edit-lembur-modal');
            $this->dispatch('alert-success', title: 'Lembur Successfully Edited!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Edit Lembur');
        }
    }
}
