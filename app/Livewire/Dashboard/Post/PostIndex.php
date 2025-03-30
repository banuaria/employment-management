<?php

namespace App\Livewire\Dashboard\Post;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PostIndex extends Component
{
    use WithPagination;

    #[Url(as: 'q', except: '')]
    public string $search = '';
    #[Url(as: 'sort', except: 'created_at')]
    public string $sort_field = 'created_at';
    #[Url(as: 'direction', except: 'desc')]
    public string $sort_direction = 'desc';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sort_field === $field) {
            $this->sort_direction = $this->sort_direction === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sort_field = $field;
            $this->sort_direction = 'desc';
        }
        $this->resetPage();
    }

    #[On('listen-alert-confirmation')]
    public function listenAlertConfirmation($do, $id)
    {
        if ($do === 'delete') {
            $this->delete($id);
        }
    }

    public function render()
    {
        $posts = Post::with(['postCategory', 'postSubcategory', 'postTags', 'createdBy', 'updatedBy', 'publishedBy'])
            ->when($this->search !== '', fn (Builder $query) => $query->where('title', 'like', '%'. $this->search .'%'))
            ->orderBy($this->sort_field, $this->sort_direction)->paginate(10);

        $data = [
            'posts' => $posts,
        ];
        
        return view('livewire.dashboard.post.post-index', $data)->layout('layouts.dashboard', [
            'header' => 'Posts'
        ]);
    }

    public function updateHighlight($id, $highlight)
    {
        $posts = Post::where('highlight', 1)->count();

        if ($posts) {
            if ($posts >= 4 && $highlight == true) {
                $this->dispatch('alert-failure', title: 'Post Highlights are limited to 4 items only.');
                return;
            }
        }

        $post = Post::find($id);

        if ($post) {
            $post->update(['highlight' => $highlight, 'updated_by' => auth()->id()]);
            $this->dispatch('alert-success', title: 'Post Highlight Successfully Updated!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Update Post Highlight');
        }
       
    }

    public function updateStatus($id, $status)
    {
        $post = Post::find($id);
        if ($post) {
            $post->update(['status' => $status, 'updated_by' => auth()->id()]);
            if ($post->published_by == null && $post->published_at == null) {
                $post->update(['published_by' => auth()->id(), 'published_at' => Carbon::now()]);
            }
            $this->dispatch('alert-success', title: 'Post Status Successfully Updated!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Update Post Status');
        }
    }

    public function delete($id)
    {
        $post = Post::find($id);
        if ($post->delete()) {
            $this->dispatch('alert-success', title: 'Post Successfully Deleted!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Delete Post');
        }
    }
}
