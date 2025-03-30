<?php

namespace App\Livewire\Dashboard\Lainya;

use App\Models\Lainya;
use Livewire\Attributes\On;
use Livewire\Component;

class LainyaEdit extends Component
{
    public $lainyaID;
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
        $lainyaID = Lainya::find($id);

        $this->lainyaID  = $lainyaID;
        $this->total = $lainyaID->total;
          
        $this->dispatch('open-modal', name: 'edit-lainya-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.lainya.lainya-edit');
    }

    public function store()
    {
        $lainyaID = $this->lainyaID;
        $validated = $this->validate([
            'total'  => ['required', 'numeric'],
        ]);

        $lainyaID->update($validated);

        if ($lainyaID) {
            $this->dispatch('lainya-edited');
            $this->dispatch('close-modal', name: 'edit-lainya-modal');
            $this->dispatch('alert-success', title: 'Lainya Successfully Edited!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Edit Lainya');
        }
    }
}
