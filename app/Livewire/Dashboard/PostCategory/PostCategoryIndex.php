<?php

namespace App\Livewire\Dashboard\PostCategory;

use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PostCategoryIndex extends Component
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
        $post_categories = PostCategory::with(['postSubcategories', 'createdBy', 'updatedBy'])
            ->when($this->search !== '', fn (Builder $query) => $query->where('title', 'like', '%'. $this->search .'%'))
            ->orderBy($this->sort_field, $this->sort_direction)->paginate(10);

        $data = [
            'post_categories' => $post_categories,
        ];

        return view('livewire.dashboard.post-category.post-category-index', $data)->layout('layouts.dashboard', [
            'header' => 'Post Categories'
        ]);
    }

    public function updateStatus($id, $status)
    {
        $post_category = PostCategory::find($id);
        if ($post_category) {
            $post_category->update(['status' => $status, 'updated_by' => auth()->id()]);

            $this->dispatch('alert-success', title: 'Post Category Status Successfully Updated!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Update Post Category Status');
        }
    }

    public function delete($id)
    {
        $post_category = PostCategory::destroy($id);
        if ($post_category) {
            $this->dispatch('alert-success', title: 'Post Category Successfully Deleted!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Delete Post Category');
        }
    }
}
