<?php

namespace App\Livewire\Main;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class MainSearch extends Component
{
    use WithPagination;

    public $keywords;
    public $per_page = 8;
    public string $sort_field = 'created_at';
    public string $sort_direction = 'asc';

    public function mount()
    {
        $this->keywords = request()->query('keywords', $this->keywords);
    }

    public function render()
    {
        $posts = Post::when($this->keywords, function ($query) {
            $query->where('title', 'like', '%' . $this->keywords . '%');
        })->orderBy($this->sort_field, $this->sort_direction)->paginate($this->per_page);

        return view('livewire.main.main-search', [
            'posts' => $posts,
        ])->layout('layouts.main');
    }

    public function loadMore()
    {
        $this->per_page += 4;
    }
}
