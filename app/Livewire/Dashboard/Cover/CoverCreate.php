<?php

namespace App\Livewire\Dashboard\Cover;

use App\Models\Cover;
use Livewire\Attributes\On;
use Livewire\Component;

class CoverCreate extends Component
{
    public $path = '';
    public $url = '';

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

    #[On('created')]
    public function created()
    {
        $this->dispatch('open-modal', name: 'create-cover-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.cover.cover-create');
    }

    public function store()
    {
        $validated = $this->validate([
            'path' => ['required', 'string', 'max:255'],
            'url'  => ['required', 'string', 'max:255'],
        ]);

        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        try {
            Cover::create($validated);

            $this->dispatch('cover-created');
            $this->dispatch('close-modal', name: 'create-cover-modal');
            $this->dispatch('alert-success', title: 'Cover Successfully Created!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Create Cover');
        }
    }
}
