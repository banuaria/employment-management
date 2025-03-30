<?php

namespace App\Livewire\Dashboard\About;

use App\Models\About;
use Livewire\Attributes\On;
use Livewire\Component;

class AboutEdit extends Component
{
    public $about;
    public $content;

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    #[On('tinymce-textarea')]
    public function tinymceTextarea($value, $textareaId)
    {
        if ($textareaId === '1') {
            $this->content = $value;
        }
    }

    #[On('edited')]
    public function edited()
    {
        $about = About::first();

        $this->about   = $about;
        $this->content = $about->content;

        $this->dispatch('modal-refresh');
        $this->dispatch('open-modal', name: 'edit-about-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.about.about-edit');
    }

    public function store()
    {
        $about = $this->about;

        $validated = $this->validate([
            'content' => ['nullable', 'string'],
        ]);

        $validated = array_map(function ($value) {
            return $value === '' ? null : $value;
        }, $validated);

        $validated['updated_by'] = auth()->id();

        try {
            $about->update($validated);

            $this->dispatch('about-edited');
            $this->dispatch('close-modal', name: 'edit-about-modal');
            $this->dispatch('alert-success', title: 'About Successfully Edited!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Edit About');
        }
    }
}
