<?php

namespace App\Livewire\Dashboard\Vendor;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class VendorIndex extends Component
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
        $vendorEmploy = Vendor::when($this->search !== '', fn (Builder $query) => $query->where('name', 'like', '%'. $this->search .'%'))
            ->orderBy($this->sort_field, $this->sort_direction)
            ->paginate(30);

        $data = [
            'vendorEmploy' => $vendorEmploy,
        ];

        return view('livewire.dashboard.vendor.vendor-index', $data)->layout('layouts.dashboard', [
            'header' => 'vendor'
        ]);
    }

    public function updateStatus($id, $status)
    {
        $vendor = Vendor::find($id);
        if ($vendor) {
            $vendor->update(['status' => $status]);

            $this->dispatch('alert-success', title: 'Vendor Status Successfully Updated!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Update Vendor Status');
        }
    }

    public function delete($id)
    {
        $vendor = Vendor::destroy($id);
        if ($vendor) {
            $this->dispatch('alert-success', title: 'Vendor Successfully Deleted!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Delete Vendor');
        }
    }
}
