<?php

namespace App\Livewire\Dashboard\PostTag;

use App\Models\PostTag;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class PostTagEdit extends Component
{
    public $post_tag;
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
        $post_tag = PostTag::find($id);

        $this->post_tag = $post_tag;
        $this->title    = $post_tag->title;

        $this->dispatch('open-modal', name: 'edit-post-tag-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.post-tag.post-tag-edit');
    }

    public function store()
    {
        $post_tag = $this->post_tag;

        $validated = $this->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use($post_tag) {
                    if (PostTag::where('slug', Str::slug($value))->where('id', '!=', $post_tag->id)->exists()) {
                        $fail('The title must be unique.');
                    }
                }
            ],
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['updated_by'] = auth()->id();

        try {
            $post_tag->update($validated);

            $this->dispatch('post-tag-edited');
            $this->dispatch('close-modal', name: 'edit-post-tag-modal');
            $this->dispatch('alert-success', title: 'Post Tag Successfully Edited!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Edit Post Tag');
        }
    }
}
