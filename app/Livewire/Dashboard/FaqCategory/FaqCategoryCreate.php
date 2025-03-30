<?php

namespace App\Livewire\Dashboard\FaqCategory;

use App\Models\FaqCategory;
use Livewire\Attributes\On;
use Livewire\Component;

class FaqCategoryCreate extends Component
{
    public $title = '';

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    #[On('created')]
    public function created()
    {
        $this->dispatch('open-modal', name: 'create-faq-category-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.faq-category.faq-category-create');
    }

    public function store()
    {
        $validated = $this->validate([
            'title' => ['required', 'string', 'max:255', 'unique:'.FaqCategory::class],
        ]);

        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        try {
            FaqCategory::create($validated);

            $this->dispatch('faq-category-created');
            $this->dispatch('close-modal', name: 'create-faq-category-modal');
            $this->dispatch('alert-success', title: 'Faq Category Successfully Created!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Create Faq Category');
        }
    }
}
