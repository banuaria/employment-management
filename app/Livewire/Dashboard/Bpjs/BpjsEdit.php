<?php

namespace App\Livewire\Dashboard\Bpjs;

use App\Models\EmployBpjs;
use Livewire\Attributes\On;
use Livewire\Component;

class BpjsEdit extends Component
{
    public $bpjsID;
    public $month_year;
    public $vendor_id;
    public $employee_id;
    public $jht;
    public $jkm;
    public $jkk;
    public $jp;
    public $kes;

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    #[On('edited')]
    public function edited($id)
    {
        $bpjsID = EmployBpjs::find($id);

        $this->bpjsID  = $bpjsID;
        $this->jht = $bpjsID->jht;
        $this->jkk = $bpjsID->jkk;
        $this->jkm = $bpjsID->jkm;
        $this->jp = $bpjsID->jp;
        $this->kes = $bpjsID->kes;

          
        $this->dispatch('open-modal', name: 'edit-bpjs-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.bpjs.bpjs-edit');
    }

    public function store()
    {
        $bpjsID = $this->bpjsID;
        $validated = $this->validate([
            'jht'  => ['required', 'numeric'],
            'jkk'  => ['required', 'numeric'],
            'jkm'  => ['required', 'numeric'],
            'jp'  => ['required', 'numeric'],
            'kes'  => ['required', 'numeric'],
        ]);

        $bpjsID->update($validated);

        if ($bpjsID) {
            $this->dispatch('bpjs-edited');
            $this->dispatch('close-modal', name: 'edit-bpjs-modal');
            $this->dispatch('alert-success', title: 'BPJS Successfully Edited!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Edit BPJS');
        }
    }
}
