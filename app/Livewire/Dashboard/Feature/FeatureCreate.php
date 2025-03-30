<?php

namespace App\Livewire\Dashboard\Feature;

use App\Models\Feature;
use Livewire\Attributes\On;
use Livewire\Component;

class FeatureCreate extends Component
{
    public $title = '';
    public $path = '';
    public $desc = '';

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    #[On('listen-filemanager-picker')]
    public function filemanagerPicker($property, $path)
    {
        if ($property === 'path') {
            $this->path = $path;
        }
    }

    public function resetFilemanagerPicker($property)
    {
        if ($property === 'path') {
            $this->path = null;
        }
    }

    #[On('tinymce-textarea')]
    public function tinymceTextarea($value, $textareaId)
    {
        if ($textareaId === '1') {
            $this->desc = $value;
        }
    }

    #[On('created')]
    public function created()
    {
        $this->dispatch('open-modal', name: 'create-feature-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.feature.feature-create');
    }

    public function store()
    {
        $validated = $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'path'  => ['required', 'string', 'max:255'],
            'desc'  => ['required', 'string'],
        ]);

        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        try {
            Feature::create($validated);

            $this->dispatch('feature-created');
            $this->dispatch('close-modal', name: 'create-feature-modal');
            $this->dispatch('alert-success', title: 'Feature Successfully Created!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Create Feature');
        }
    }
}
