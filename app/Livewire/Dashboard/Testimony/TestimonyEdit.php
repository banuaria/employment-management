<?php

namespace App\Livewire\Dashboard\Testimony;

use App\Models\Testimony;
use Livewire\Attributes\On;
use Livewire\Component;

class TestimonyEdit extends Component
{
    public $testimony;
    public $name = '';
    public $profile_pic = '';
    public $designation = '';
    public $content = '';

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    #[On('edited')]
    public function edited($id)
    {
        $testimony = Testimony::find($id);

        $this->testimony   = $testimony;
        $this->name        = $testimony->name;
        $this->profile_pic = $testimony->profile_pic;
        $this->designation = $testimony->designation;
        $this->content     = $testimony->content;

        $this->dispatch('open-modal', name: 'edit-testimony-modal');
    }

    #[On('listen-filemanager-picker')]
    public function filemanagerPicker($property, $path)
    {
        if ($property === 'profile_pic') {
            $this->profile_pic = $path;
        }
    }

    public function resetFilemanagerPicker($property)
    {
        if ($property === 'profile_pic') {
            $this->profile_pic = null;
        }
    }

    public function render()
    {
        return view('livewire.dashboard.testimony.testimony-edit');
    }

    public function store()
    {
        $testimony = $this->testimony;

        $validated = $this->validate([
            'name' => ['required', 'string','max:255'],
            'profile_pic' => ['nullable', 'string','max:255'],
            'designation' => ['nullable', 'string','max:255'],
            'content' => ['required', 'string'],
        ]);

        $validated = array_map(function ($value) {
            return $value === '' ? null : $value;
        }, $validated);

        $validated['updated_by'] = auth()->id();

        try {
            $testimony->update($validated);

            $this->dispatch('testimony-edited');
            $this->dispatch('close-modal', name: 'edit-testimony-modal');
            $this->dispatch('alert-success', title: 'Testimony Successfully Edited!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Edit Testimony');
        }
    }
}
