<?php

namespace App\Livewire\Dashboard\Term;

use App\Models\Term;
use Livewire\Attributes\On;
use Livewire\Component;

class TermEdit extends Component
{
    public $term;
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
        $term = Term::first();

        $this->term    = $term;
        $this->content = $term->content;

        $this->dispatch('modal-refresh');
        $this->dispatch('open-modal', name: 'edit-term-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.term.term-edit');
    }

    public function store()
    {
        $term = $this->term;

        $validated = $this->validate([
            'content' => ['nullable', 'string'],
        ]);

        $validated = array_map(function ($value) {
            return $value === '' ? null : $value;
        }, $validated);

        $validated['updated_by'] = auth()->id();

        try {
            $term->update($validated);

            $this->dispatch('term-edited');
            $this->dispatch('close-modal', name: 'edit-term-modal');
            $this->dispatch('alert-success', title: 'Terms & Conditions Successfully Edited!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Edit Terms & Conditions');
        }
    }
}
