<?php

namespace App\Livewire\Dashboard\Vendor;

use App\Models\Vendor;
use Livewire\Attributes\On;
use Livewire\Component;

class VendorEdit extends Component
{
    public $vendorID;
    public string $name = '';

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    #[On('edited')]
    public function edited($id)
    {
        $vendorID = Vendor::find($id);

        $this->vendorID  = $vendorID;
        $this->name  = $vendorID->name;

        $this->dispatch('open-modal', name: 'edit-vendor-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.vendor.vendor-edit');
    }

    public function store()
    {
        $vendorID = $this->vendorID;

        $validated = $this->validate([
            'name'  => ['required', 'string', 'max:255'],
        ]);

        $vendorID->update($validated);

        if ($vendorID) {
            $this->dispatch('vendor-edited');
            $this->dispatch('close-modal', name: 'edit-vendor-modal');
            $this->dispatch('alert-success', title: 'Vendor Successfully Edited!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Edit Vendor');
        }
    }
}
