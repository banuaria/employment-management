<?php

namespace App\Livewire\Dashboard\Post;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostSubcategory;
use App\Models\PostTag;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class PostCreate extends Component
{
    public $post_categories = [];
    public $post_category_id = '';
    public $post_subcategories = [];
    public $post_subcategory_id = '';
    public $post_tags = [];
    public $post_tag_ids = [];
    public $thumbnail = '';
    public $cover = '';
    public $title = '';
    public $content = '';
    public $meta_title = '';
    public $meta_desc = '';
    public $meta_keywords = '';

    #[On('tinymce-textarea')]
    public function tinymceTextarea($value, $textareaId)
    {
        if ($textareaId === '1') {
            $this->content = $value;
        }
    }

    #[On('select2-select')]
    public function select2select($values, $selectId)
    {
        if ($selectId === '1') {
            $this->post_tag_ids = $values;
        }
    }

    #[On('listen-filemanager-picker')]
    public function filemanagerPicker($property, $path)
    {
        if ($property === 'thumbnail') {
            $this->thumbnail = $path;
        } else if ($property === 'cover') {
            $this->cover = $path;
        }
    }

    public function resetFilemanagerPicker($property)
    {
        if ($property === 'thumbnail') {
            $this->thumbnail = null;
        } else if ($property === 'cover') {
            $this->cover = null;
        }
    }

    public function updatedPostCategoryId()
    {
        $this->post_subcategories = PostSubcategory::where('post_category_id', $this->post_category_id)->pluck('title', 'id');
        $this->reset('post_subcategory_id');
    }

    public function mount()
    {
        $this->post_categories = PostCategory::pluck('title', 'id');
        $this->post_tags = PostTag::pluck('title', 'id');
    }

    public function render()
    {
        return view('livewire.dashboard.post.post-create')->layout('layouts.dashboard', [
            'header' => 'Post Create'
        ]);
    }

    public function store()
    {
        $validated = $this->validate([
            'post_category_id'    => ['nullable'],
            'post_subcategory_id' => ['nullable'],
            'post_tag_ids'        => ['nullable', 'array'],
            'thumbnail'           => ['nullable', 'string', 'max:255'],
            'cover'               => ['nullable', 'string', 'max:255'],
            'title'               => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (Post::where('slug', Str::slug($value))->exists()) {
                        $fail('The title must be unique.');
                    }
                }
            ],
            'content'             => ['required', 'string'],
            'meta_title'          => ['nullable', 'string', 'max:255'],
            'meta_desc'           => ['nullable', 'string', 'max:255'],
            'meta_keywords'       => ['nullable', 'string', 'max:255'],
        ]);

        $validated = array_map(function ($value) {
            return $value === '' ? null : $value;
        }, $validated);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        try {
            $post = Post::create($validated);

            $post->postTags()->sync($validated['post_tag_ids']);

            $this->dispatch('alert-success', title: 'Post Successfully Created!', redirect: '/cms/post-edit/'.$post->id);
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Create Post');
        }
    }
}
