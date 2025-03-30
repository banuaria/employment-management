<?php

namespace App\Livewire\Dashboard\PostTag;

use App\Models\PostTag;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PostTagIndex extends Component
{
    use WithPagination;

    #[Url(as: 'q', except: '')]
    public string $search = '';
    #[Url(as: 'sort', except: 'created_at')]
    public string $sort_field = 'created_at';
    #[Url(as: 'direction', except: 'asc')]
    public string $sort_direction = 'asc';

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
        $post_tags = PostTag::with(['createdBy', 'updatedBy'])
            ->when($this->search !== '', fn (Builder $query) => $query->where('title', 'like', '%'. $this->search .'%'))
            ->orderBy($this->sort_field, $this->sort_direction)->paginate(10);

        $data = [
            'post_tags' => $post_tags,
        ];

        return view('livewire.dashboard.post-tag.post-tag-index', $data)->layout('layouts.dashboard', [
            'header' => 'Post Tags'
        ]);
    }

    public function updateStatus($id, $status)
    {
        $post_tag = PostTag::find($id);
        if ($post_tag) {
            $post_tag->update(['status' => $status, 'updated_by' => auth()->id()]);

            $this->dispatch('alert-success', title: 'Post Tag Status Successfully Updated!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Update Post Tag Status');
        }
    }

    public function delete($id)
    {
        $post_tag = PostTag::destroy($id);
        if ($post_tag) {
            $this->dispatch('alert-success', title: 'Post Tag Successfully Deleted!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Delete Post Tag');
        }
    }
}
