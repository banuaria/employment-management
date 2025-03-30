<?php

namespace App\Livewire\Dashboard\LocationCategory;

use App\Models\LocationCategory;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class LocationCategoryIndex extends Component
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
        $location_categories = LocationCategory::with(['createdBy', 'updatedBy'])
            ->when($this->search !== '', fn (Builder $query) => $query->where('title', 'like', '%'. $this->search .'%'))
            ->orderBy($this->sort_field, $this->sort_direction)->paginate(10);

        $data = [
            'location_categories' => $location_categories,
        ];
        
        return view('livewire.dashboard.location-category.location-category-index', $data)->layout('layouts.dashboard', [
            'header' => 'Location Categories'
        ]);
    }

    public function updateStatus($id, $status)
    {
        $location_category = LocationCategory::find($id);
        if ($location_category) {
            $location_category->update(['status' => $status, 'updated_by' => auth()->id()]);

            $this->dispatch('alert-success', title: 'Location Category Status Successfully Updated!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Update Location Category Status');
        }
    }

    public function delete($id)
    {
        $location_category = LocationCategory::destroy($id);
        if ($location_category) {
            $this->dispatch('alert-success', title: 'Location Category Successfully Deleted!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Delete Location Category');
        }
    }
}
