<?php

namespace App\Livewire\Dashboard\Faq;

use App\Models\Faq;
use Livewire\Attributes\On;
use Livewire\Component;

class FaqCreate extends Component
{
    public $faq_categories = [];
    public $faq_category_id = '';
    public $question = '';
    public $answer = '';

    public function validationAttributes()
    {
        $attributes = [];
        $attributes["faq_category_id"] = 'category';
        return $attributes;
    }

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset('faq_category_id');
        $this->reset('question');
        $this->reset('answer');
        $this->resetValidation();
    }

    #[On('tinymce-textarea')]
    public function tinymceTextarea($value, $textareaId)
    {
        if ($textareaId === '1') {
            $this->answer = $value;
        }
    }

    #[On('created')]
    public function created()
    {
        $this->dispatch('modal-refresh');
        $this->dispatch('open-modal', name: 'create-faq-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.faq.faq-create');
    }

    public function store()
    {
        $validated = $this->validate([
            'faq_category_id' => ['required'],
            'question'        => ['required', 'string', 'max:255'],
            'answer'          => ['required', 'string'],
        ]);

        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        try {
            Faq::create($validated);

            $this->dispatch('faq-created');
            $this->dispatch('close-modal', name: 'create-faq-modal');
            $this->dispatch('alert-success', title: 'Faq Successfully Created!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Create Faq');
        }
    }
}
