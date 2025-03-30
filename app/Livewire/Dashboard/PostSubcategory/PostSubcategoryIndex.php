<?php

namespace App\Livewire\Dashboard\PostSubcategory;

use App\Models\PostCategory;
use App\Models\PostSubcategory;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PostSubcategoryIndex extends Component
{
    use WithPagination;

    public $post_categories = [];

    #[Url(as: 'post_category_id', except: '')]
    public string $post_category_id = '';
    #[Url(as: 'q', except: '')]
    public string $search = '';
    #[Url(as: 'sort', except: 'created_at')]
    public string $sort_field = 'created_at';
    #[Url(as: 'direction', except: 'asc')]
    public string $sort_direction = 'asc';

    public function updating($property)
    {
        if ($property === 'post_category_id' || $property === 'search') {
            $this->resetPage();
        }
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

    public function mount()
    {
        $this->post_categories = PostCategory::pluck('title', 'id');
    }

    public function render()
    {
        $post_subcategories = PostSubcategory::with(['postCategory', 'createdBy', 'updatedBy'])
            ->when($this->post_category_id !== '', fn (Builder $query) => $query->where('post_category_id', $this->post_category_id))
            ->when($this->search !== '', fn (Builder $query) => $query->where('title', 'like', '%'. $this->search .'%'))
            ->orderBy($this->sort_field, $this->sort_direction)->paginate(10);

        $data = [
            'post_subcategories' => $post_subcategories,
        ];

        return view('livewire.dashboard.post-subcategory.post-subcategory-index', $data)->layout('layouts.dashboard', [
            'header' => 'Post Subcategories'
        ]);
    }

    public function updateStatus($id, $status)
    {
        $post_subcategory = PostSubcategory::find($id);
        if ($post_subcategory) {
            $post_subcategory->update(['status' => $status, 'updated_by' => auth()->id()]);

            $this->dispatch('alert-success', title: 'Post Subcategory Status Successfully Updated!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Update Post Subcategory Status');
        }
    }

    public function delete($id)
    {
        $post_subcategory = PostSubcategory::destroy($id);
        if ($post_subcategory) {
            $this->dispatch('alert-success', title: 'Post Subcategory Successfully Deleted!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Delete Post Subcategory');
        }
    }
}
