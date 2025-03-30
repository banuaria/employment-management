<?php

namespace App\Livewire\Dashboard\PostCategory;

use App\Models\PostCategory;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class PostCategoryEdit extends Component
{
    public $post_category;
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
        $post_category = PostCategory::find($id);

        $this->post_category = $post_category;
        $this->title         = $post_category->title;

        $this->dispatch('open-modal', name: 'edit-post-category-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.post-category.post-category-edit');
    }

    public function store()
    {
        $post_category = $this->post_category;

        $validated = $this->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use($post_category) {
                    if (PostCategory::where('slug', Str::slug($value))->where('id', '!=', $post_category->id)->exists()) {
                        $fail('The title must be unique.');
                    }
                }
            ],
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['updated_by'] = auth()->id();

        try {
            $post_category->update($validated);

            $this->dispatch('post-category-edited');
            $this->dispatch('close-modal', name: 'edit-post-category-modal');
            $this->dispatch('alert-success', title: 'Post Category Successfully Edited!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Edit Post Category');
        }
    }
}
