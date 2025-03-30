<?php

namespace App\Livewire\Dashboard\PostSubcategory;

use App\Models\PostSubcategory;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class PostSubcategoryCreate extends Component
{
    public $post_categories = [];
    public $post_category_id = '';
    public $title = '';

    public function validationAttributes()
    {
        $attributes = [];
        $attributes["post_category_id"] = 'category';
        return $attributes;
    }

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset('post_category_id');
        $this->reset('title');
        $this->resetValidation();
    }

    #[On('created')]
    public function created()
    {
        $this->dispatch('open-modal', name: 'create-post-subcategory-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.post-subcategory.post-subcategory-create');
    }

    public function store()
    {
        $validated = $this->validate([
            'post_category_id' => ['required'],
            'title' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (PostSubcategory::where('slug', Str::slug($value))->exists()) {
                        $fail('The title must be unique.');
                    }
                }
            ],
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        try {
            PostSubcategory::create($validated);

            $this->dispatch('post-subcategory-created');
            $this->dispatch('close-modal', name: 'create-post-subcategory-modal');
            $this->dispatch('alert-success', title: 'Post Subcategory Successfully Created!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Create Post Subcategory');
        }
    }
}
