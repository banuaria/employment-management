<?php

namespace App\Livewire\Dashboard\Area;

use App\Models\AreaPayroll;
use Livewire\Attributes\On;
use Livewire\Component;

class AreaEdit extends Component
{
    public $areaID;
    public string $area = '';
    public string $name = '';
    public int $umk;
    public $total_harian;

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    #[On('edited')]
    public function edited($id)
    {
        $areaID = AreaPayroll::find($id);

        $this->areaID  = $areaID;
        $this->name  = $areaID->name;
        $this->area = $areaID->area;
        $this->umk  = $areaID->umk;
        $this->total_harian  = $areaID->total_harian;

        $this->dispatch('open-modal', name: 'edit-area-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.area.area-edit');
    }

    public function store()
    {
        $areaID = $this->areaID;

        $validated = $this->validate([
            'name'  => ['required', 'string', 'max:255'],
            'area'  => ['required', 'string', 'max:10'],
            'umk'  => ['required', 'numeric'],
            'total_harian'  => ['nullable', 'numeric'],
        ]);
        // dd($validated, $areaID);

        // $areaValue = AreaPayroll::find($areaID); 
        $areaID->update($validated);

        if ($areaID) {
            $this->dispatch('area-edited');
            $this->dispatch('close-modal', name: 'edit-area-modal');
            $this->dispatch('alert-success', title: 'Area Successfully Edited!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Edit Area');
        }
    }
}
