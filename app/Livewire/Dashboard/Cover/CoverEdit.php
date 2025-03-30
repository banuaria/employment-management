<?php

namespace App\Livewire\Dashboard\Cover;

use App\Models\Cover;
use Livewire\Attributes\On;
use Livewire\Component;

class CoverEdit extends Component
{
    public $cover;
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

    #[On('edited')]
    public function edited($id)
    {
        $cover = Cover::find($id);

        $this->cover = $cover;
        $this->path  = $cover->path;
        $this->url   = $cover->url;

        $this->dispatch('open-modal', name: 'edit-cover-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.cover.cover-edit');
    }

    public function store()
    {
        $cover = $this->cover;

        $validated = $this->validate([
            'path' => ['required', 'string', 'max:255'],
            'url'  => ['required', 'string', 'max:255'],
        ]);

        $validated['updated_by'] = auth()->id();

        try {
            $cover->update($validated);

            $this->dispatch('cover-edited');
            $this->dispatch('close-modal', name: 'edit-cover-modal');
            $this->dispatch('alert-success', title: 'Cover Successfully Edited!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Edit Cover');
        }
    }
}
