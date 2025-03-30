<?php

namespace App\Livewire\Dashboard\FaqCategory;

use App\Models\FaqCategory;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class FaqCategoryEdit extends Component
{
    public $faq_category;
    public $title = '';

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    #[On('edited')]
    public function edited($id)
    {
        $faq_category = FaqCategory::find($id);

        $this->faq_category = $faq_category;
        $this->title        = $faq_category->title;

        $this->dispatch('open-modal', name: 'edit-faq-category-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.faq-category.faq-category-edit');
    }

    public function store()
    {
        $faq_category = $this->faq_category;

        $validated = $this->validate([
            'title' => ['required', 'string', 'max:255', Rule::unique(FaqCategory::class)->ignore($faq_category->id)],
        ]);

        $validated['updated_by'] = auth()->id();

        try {
            $faq_category->update($validated);

            $this->dispatch('faq-category-edited');
            $this->dispatch('close-modal', name: 'edit-faq-category-modal');
            $this->dispatch('alert-success', title: 'Faq Category Successfully Edited!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Edit Faq Category');
        }
    }
}
