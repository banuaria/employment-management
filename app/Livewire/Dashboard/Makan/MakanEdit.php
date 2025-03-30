<?php

namespace App\Livewire\Dashboard\Makan;

use App\Models\Makan;
use Livewire\Attributes\On;
use Livewire\Component;

class MakanEdit extends Component
{
    public $makanID;
    public $month_year;
    public $vendor_id;
    public $employee_id;
    public $total;
    public $total_mel;
    public $total_unit;
    public $total_loading;


    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    #[On('edited')]
    public function edited($id)
    {
        $makanID = Makan::find($id);

        $this->makanID  = $makanID;
        $this->total = $makanID->total;
        $this->total_mel = $makanID->total_mel;
        $this->total_unit = $makanID->total_unit;
        $this->total_loading = $makanID->total_loading;

          
        $this->dispatch('open-modal', name: 'edit-makan-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.makan.makan-edit');
    }

    public function store()
    {
        $makanID = $this->makanID;
        $validated = $this->validate([
            'total'  => ['required', 'numeric'],
            'total_mel'  => ['required', 'numeric'],
            'total_unit'  => ['required', 'numeric'],
            'total_loading'  => ['required', 'numeric'],
        ]);

        $makanID->update($validated);

        if ($makanID) {
            $this->dispatch('makan-edited');
            $this->dispatch('close-modal', name: 'edit-makan-modal');
            $this->dispatch('alert-success', title: 'Makan Successfully Edited!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Edit Makan');
        }
    }
}
