<?php

namespace App\Livewire\Dashboard\Store;

use App\Models\Store;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class StoreIndex extends Component
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
        $stores = Store::with(['createdBy', 'updatedBy'])
            ->when($this->search !== '', fn (Builder $query) => $query->where('title', 'like', '%'. $this->search .'%')->orWhere('url', 'like', '%'. $this->search .'%'))
            ->orderBy($this->sort_field, $this->sort_direction)->paginate(10);

        $data = [
            'stores' => $stores,
        ];

        return view('livewire.dashboard.store.store-index', $data)->layout('layouts.dashboard', [
            'header' => 'Stores'
        ]);
    }

    public function updateStatus($id, $status)
    {
        $store = Store::find($id);
        if ($store) {
            $store->update(['status' => $status, 'updated_by' => auth()->id()]);

            $this->dispatch('alert-success', title: 'Store Status Successfully Updated!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Update Store Status');
        }
    }

    public function delete($id)
    {
        $store = Store::destroy($id);
        if ($store) {
            $this->dispatch('alert-success', title: 'Store Successfully Deleted!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Delete Store');
        }
    }
}
