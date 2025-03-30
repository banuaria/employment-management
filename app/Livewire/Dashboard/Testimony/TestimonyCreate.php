<?php

namespace App\Livewire\Dashboard\Testimony;

use App\Models\Testimony;
use Livewire\Attributes\On;
use Livewire\Component;

class TestimonyCreate extends Component
{
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

    #[On('created')]
    public function created()
    {
        $this->dispatch('open-modal', name: 'create-testimony-modal');
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
        return view('livewire.dashboard.testimony.testimony-create');
    }

    public function store()
    {
        $validated = $this->validate([
            'name' => ['required', 'string','max:255'],
            'profile_pic' => ['nullable', 'string','max:255'],
            'designation' => ['nullable', 'string','max:255'],
            'content' => ['required', 'string'],
        ]);

        $validated = array_map(function ($value) {
            return $value === '' ? null : $value;
        }, $validated);

        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        try {
            Testimony::create($validated);

            $this->dispatch('testimony-created');
            $this->dispatch('close-modal', name: 'create-testimony-modal');
            $this->dispatch('alert-success', title: 'Testimony Successfully Created!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Create Testimony');
        }
    }
}
