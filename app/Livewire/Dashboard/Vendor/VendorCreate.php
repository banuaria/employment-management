<?php

namespace App\Livewire\Dashboard\Vendor;

use App\Models\Vendor;
use Livewire\Attributes\On;
use Livewire\Component;

class VendorCreate extends Component
{
    public string $name = '';

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.dashboard.vendor.vendor-create');
    }

    public function store()
    {
        $validated = $this->validate([
            'name'  => ['required', 'string', 'max:255'],
        ]);

        $vendor = Vendor::create($validated);

        if ($vendor) {
            $this->dispatch('vendor-created');
            $this->dispatch('close-modal', name: 'create-vendor-modal');
            $this->dispatch('alert-success', title: 'vendor Successfully Created!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Create vendor');
        }
    }
}
