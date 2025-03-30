<?php

namespace App\Livewire\Dashboard\PostCategory;

use App\Models\PostCategory;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class PostCategoryCreate extends Component
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
        $this->dispatch('open-modal', name: 'create-post-category-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.post-category.post-category-create');
    }

    public function store()
    {
        $validated = $this->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (PostCategory::where('slug', Str::slug($value))->exists()) {
                        $fail('The title must be unique.');
                    }
                }
            ],
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        try {
            PostCategory::create($validated);

            $this->dispatch('post-category-created');
            $this->dispatch('close-modal', name: 'create-post-category-modal');
            $this->dispatch('alert-success', title: 'Post Category Successfully Created!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Create Post Category');
        }
    }
}
