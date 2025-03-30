<?php

namespace App\Livewire\Main;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class MainPostDetail extends Component
{
    public $post;
    public $related_posts;

    public function mount($slug) 
    {
        $this->post = Post::where('slug', $slug)->firstOrFail();
        $category = $this->post->postCategory;
        $related_posts = Post::with(['postCategory', 'postSubcategory', 'postTags', 'createdBy'])->when($category != null, fn (Builder $query) => $query->whereHas('postCategory', function($q) use($category) {
                $q->where('id', $category->id);
            }))
            ->active()
            ->where('id', '!=', $this->post->id)
            ->limit(4)
            ->get();
        if (count($related_posts) < 4) {
            $remaining = 4 - count($related_posts);
            $related_post_ids = $related_posts->pluck('id');
            $related_post_ids[] = $this->post->id;
            $remaining_posts = Post::with(['postCategory', 'postSubcategory', 'postTags', 'createdBy'])
                ->active()
                ->whereNotIn('id', $related_post_ids)
                ->limit($remaining)
                ->get();
            $this->related_posts = $related_posts->concat($remaining_posts);
        } else {
            $this->related_posts = $related_posts;
        }
    }

    public function render()
    {
        return view('livewire.main.main-post-detail')->layout('layouts.main');
    }
}
