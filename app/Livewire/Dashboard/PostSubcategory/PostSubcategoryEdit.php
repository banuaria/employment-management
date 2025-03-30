<?php

namespace App\Livewire\Dashboard\PostSubcategory;

use App\Models\PostSubcategory;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class PostSubcategoryEdit extends Component
{
    public $post_subcategory;
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
        $this->reset('post_subcategory');
        $this->reset('post_category_id');
        $this->reset('title');
        $this->resetValidation();
    }

    #[On('edited')]
    public function edited($id)
    {
        $post_subcategory = PostSubcategory::find($id);

        $this->post_subcategory = $post_subcategory;
        $this->post_category_id = $post_subcategory->post_category_id;
        $this->title            = $post_subcategory->title;

        $this->dispatch('open-modal', name: 'edit-post-subcategory-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.post-subcategory.post-subcategory-edit');
    }

    public function store()
    {
        $post_subcategory = $this->post_subcategory;

        $validated = $this->validate([
            'post_category_id' => ['required'],
            'title' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use($post_subcategory) {
                    if (PostSubcategory::where('slug', Str::slug($value))->where('id', '!=', $post_subcategory->id)->exists()) {
                        $fail('The title must be unique.');
                    }
                }
            ],
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['updated_by'] = auth()->id();

        try {
            $post_subcategory->update($validated);

            $this->dispatch('post-subcategory-edited');
            $this->dispatch('close-modal', name: 'edit-post-subcategory-modal');
            $this->dispatch('alert-success', title: 'Post Subcategory Successfully Edited!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Edit Post Subcategory');
        }
    }
}
