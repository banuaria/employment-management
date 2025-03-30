<?php

namespace App\Livewire\Dashboard\Post;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostSubcategory;
use App\Models\PostTag;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class PostEdit extends Component
{
    public $post;
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
    public $created_by;
    public $published_at;

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

    public function mount($id)
    {
        $post = Post::findOrFail($id);

        $this->post                = $post;
        $this->post_category_id    = $post->post_category_id;
        $this->post_subcategory_id = $post->post_subcategory_id;
        $this->post_tag_ids        = $post->postTags->pluck('id');
        $this->thumbnail           = $post->thumbnail;
        $this->cover               = $post->cover;
        $this->title               = $post->title;
        $this->content             = $post->content;
        $this->meta_title          = $post->meta_title;
        $this->meta_desc           = $post->meta_desc;
        $this->meta_keywords       = $post->meta_keywords;
        $this->created_by          = $post->createdBy->name;
        $this->published_at        = $post->published_at;

        $this->post_categories = PostCategory::pluck('title', 'id');
        if ($this->post_category_id !== '') {
            $this->post_subcategories = PostSubcategory::where('post_category_id', $this->post_category_id)->pluck('title', 'id');
        }
        $this->post_tags = PostTag::pluck('title', 'id');
    }

    public function render()
    {
        return view('livewire.dashboard.post.post-edit')->layout('layouts.dashboard', [
            'header' => 'Post Edit'
        ]);
    }

    public function store()
    {
        $post = $this->post;

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
                function ($attribute, $value, $fail) use($post) {
                    if (Post::where('slug', Str::slug($value))->where('id', '!=', $post->id)->exists()) {
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
        $validated['updated_by'] = auth()->id();

        try {
            $post->update($validated);

            $post->postTags()->sync($validated['post_tag_ids']);

            $this->dispatch('alert-success', title: 'Post Successfully Edited!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Edit Post');
        }
    }
}
