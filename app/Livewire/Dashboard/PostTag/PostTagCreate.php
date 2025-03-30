<?php

namespace App\Livewire\Dashboard\PostTag;

use App\Models\PostTag;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class PostTagCreate extends Component
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
        $this->dispatch('open-modal', name: 'create-post-tag-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.post-tag.post-tag-create');
    }

    public function store()
    {
        $validated = $this->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (PostTag::where('slug', Str::slug($value))->exists()) {
                        $fail('The title must be unique.');
                    }
                }
            ],
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        try {
            PostTag::create($validated);

            $this->dispatch('post-tag-created');
            $this->dispatch('close-modal', name: 'create-post-tag-modal');
            $this->dispatch('alert-success', title: 'Post Tag Successfully Created!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Create Post Tag');
        }
    }
}
