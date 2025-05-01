<?php

namespace App\Livewire\Dashboard\Area;

use App\Models\AreaPayroll;
use Livewire\Attributes\On;
use Livewire\Component;

class AreaCreate extends Component
{
    public string $name = '';
    public string $area = '';
    public string $umk;
    public string $total_harian = '';

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.dashboard.area.area-create');
    }

    public function store()
    {
        $validated = $this->validate([
            'name'  => ['required', 'string', 'max:255'],
            'area'   => ['required', 'string', 'max:255', 'unique:area_payrolls,area'],
            'umk'  => ['required', 'numeric'],
            'total_harian'  => ['nullable', 'numeric'],
        ]);

        //check area in area_payrolls
        $exists = AreaPayroll::where('area', $validated['area'])->exists();
        if ($exists) {
            $this->dispatch('alert-failure', title: 'Area Already Exists');
            return;
        }

        $area = AreaPayroll::create($validated);

        if ($area) {
            $this->dispatch('area-created');
            $this->dispatch('close-modal', name: 'create-area-modal');
            $this->dispatch('alert-success', title: 'area Successfully Created!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Create area');
        }
    }
}
