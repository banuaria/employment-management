<?php

namespace App\Livewire\Dashboard\Cover;

use App\Models\Cover;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class CoverIndex extends Component
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
        $covers = Cover::with(['createdBy', 'updatedBy'])
            ->when($this->search !== '', fn (Builder $query) => $query->where('url', 'like', '%'. $this->search .'%'))
            ->orderBy($this->sort_field, $this->sort_direction)->paginate(10);

        $data = [
            'covers' => $covers,
        ];

        return view('livewire.dashboard.cover.cover-index', $data);
    }

    public function updateStatus($id, $status)
    {
        $cover = Cover::find($id);
        if ($cover) {
            $cover->update(['status' => $status, 'updated_by' => auth()->id()]);

            $this->dispatch('alert-success', title: 'Cover Status Successfully Updated!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Update Cover Status');
        }
    }

    public function delete($id)
    {
        $cover = Cover::destroy($id);
        if ($cover) {
            $this->dispatch('alert-success', title: 'Cover Successfully Deleted!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Delete Cover');
        }
    }
}
