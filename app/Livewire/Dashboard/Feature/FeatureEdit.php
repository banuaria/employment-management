<?php

namespace App\Livewire\Dashboard\Feature;

use App\Models\Feature;
use Livewire\Attributes\On;
use Livewire\Component;

class FeatureEdit extends Component
{
    public $feature;
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

    #[On('edited')]
    public function edited($id)
    {
        $feature = Feature::find($id);

        $this->feature = $feature;
        $this->title   = $feature->title;
        $this->path    = $feature->path;
        $this->desc    = $feature->desc;

        $this->dispatch('modal-refresh');
        $this->dispatch('open-modal', name: 'edit-feature-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.feature.feature-edit');
    }

    public function store()
    {
        $feature = $this->feature;

        $validated = $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'path'  => ['required', 'string', 'max:255'],
            'desc'  => ['required', 'string'],
        ]);

        $validated['updated_by'] = auth()->id();

        try {
            $feature->update($validated);

            $this->dispatch('feature-edited');
            $this->dispatch('close-modal', name: 'edit-feature-modal');
            $this->dispatch('alert-success', title: 'Feature Successfully Edited!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Edit Feature');
        }
    }
}
