<?php

namespace App\Livewire\Dashboard\Area;

use App\Models\AreaPayroll;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class AreaIndex extends Component
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
        $areaEmploy = AreaPayroll::when($this->search !== '', fn (Builder $query) => $query->where('name', 'like', '%'. $this->search .'%'))
            ->orderBy($this->sort_field, $this->sort_direction)
            ->paginate(30);

        $data = [
            'areaEmploy' => $areaEmploy,
        ];

        return view('livewire.dashboard.area.area-index', $data)->layout('layouts.dashboard', [
            'header' => 'area'
        ]);
    }

    public function updateStatus($id, $status)
    {
        $area = AreaPayroll::find($id);
        if ($area) {
            $area->update(['status' => $status]);

            $this->dispatch('alert-success', title: 'Area Status Successfully Updated!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Update Area Status');
        }
    }

    public function delete($id)
    {
        $area = AreaPayroll::destroy($id);
        if ($area) {
            $this->dispatch('alert-success', title: 'Area Successfully Deleted!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Delete Area');
        }
    }
}
