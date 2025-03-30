<?php

namespace App\Livewire\Dashboard\LocationCategory;

use App\Models\LocationCategory;
use Livewire\Attributes\On;
use Livewire\Component;

class LocationCategoryCreate extends Component
{
    public $title = '';

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    #[On('created')]
    public function created()
    {
        $this->dispatch('open-modal', name: 'create-location-category-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.location-category.location-category-create');
    }

    public function store()
    {
        $validated = $this->validate([
            'title' => ['required', 'string', 'max:255', 'unique:'.LocationCategory::class],
        ]);

        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        try {
            LocationCategory::create($validated);

            $this->dispatch('location-category-created');
            $this->dispatch('close-modal', name: 'create-location-category-modal');
            $this->dispatch('alert-success', title: 'Location Category Successfully Created!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Create Location Category');
        }
    }
}
