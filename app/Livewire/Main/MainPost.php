<?php

namespace App\Livewire\Main;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class MainPost extends Component
{
    public $post_categories = [];
    public $highlight_posts = [];

    public string $post_category_id = '';
    public string $sort_field = 'created_at';
    public string $sort_direction = 'asc';

    public $per_page = 8;

    public function updating($property)
    {
        if ($property === 'post_category_id') {
            $this->resetPage();
        }
    }

    public function mount()
    {
        $this->post_categories = PostCategory::pluck('title', 'id');
        $this->highlight_posts = Post::with(['postCategory', 'postSubcategory', 'postTags', 'createdBy'])
            ->active()
            ->limit(5)
            ->get();
    }

    public function render()
    {
        $posts = Post::with(['postCategory', 'postSubcategory', 'postTags', 'createdBy'])
            ->active()
            ->when($this->post_category_id !== '', fn (Builder $query) => $query->where('post_category_id', $this->post_category_id))
            ->orderBy($this->sort_field, $this->sort_direction)->paginate($this->per_page);
        
        $data = [
            'posts' => $posts,
        ];
        
        return view('livewire.main.main-post', $data)->layout('layouts.main');
    }

    public function setActive($id)
    {
        $this->post_category_id = $id;
    }

    public function loadMore()
    {
        $this->per_page += 8;
    }
}
