<?php

namespace App\Livewire\Dashboard\Faq;

use App\Models\Faq;
use Livewire\Attributes\On;
use Livewire\Component;

class FaqEdit extends Component
{
    public $faq;
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
        $this->reset('faq');
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

    #[On('edited')]
    public function edited($id)
    {
        $faq = Faq::find($id);

        $this->faq             = $faq;
        $this->faq_category_id = $faq->faq_category_id;
        $this->question        = $faq->question;
        $this->answer          = $faq->answer;

        $this->dispatch('modal-refresh');
        $this->dispatch('open-modal', name: 'edit-faq-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.faq.faq-edit');
    }

    public function store()
    {
        $faq = $this->faq;

        $validated = $this->validate([
            'faq_category_id' => ['required'],
            'question'        => ['required', 'string', 'max:255'],
            'answer'          => ['required', 'string'],
        ]);

        $validated['updated_by'] = auth()->id();

        try {
            $faq->update($validated);

            $this->dispatch('faq-edited');
            $this->dispatch('close-modal', name: 'edit-faq-modal');
            $this->dispatch('alert-success', title: 'Faq Successfully Edited!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Edit Faq');
        }
    }
}
