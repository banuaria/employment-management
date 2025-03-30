<?php

namespace App\Livewire\Dashboard\LocationCategory;

use App\Models\LocationCategory;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class LocationCategoryEdit extends Component
{
    public $location_category;
    public $title = '';

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    #[On('edited')]
    public function edited($id)
    {
        $location_category = LocationCategory::find($id);

        $this->location_category = $location_category;
        $this->title             = $location_category->title;

        $this->dispatch('open-modal', name: 'edit-location-category-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.location-category.location-category-edit');
    }

    public function store()
    {
        $location_category = $this->location_category;

        $validated = $this->validate([
            'title' => ['required', 'string', 'max:255', Rule::unique(LocationCategory::class)->ignore($location_category->id)],
        ]);

        $validated['updated_by'] = auth()->id();

        try {
            $location_category->update($validated);

            $this->dispatch('location-category-edited');
            $this->dispatch('close-modal', name: 'edit-location-category-modal');
            $this->dispatch('alert-success', title: 'Location Category Successfully Edited!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Edit Location Category');
        }
    }
}
