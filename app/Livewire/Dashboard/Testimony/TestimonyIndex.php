<?php

namespace App\Livewire\Dashboard\Testimony;

use App\Models\Testimony;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class TestimonyIndex extends Component
{
    use WithPagination;

    #[Url(as: 'sort', except: 'created_at')]
    public string $sort_field = 'created_at';
    #[Url(as: 'direction', except: 'asc')]
    public string $sort_direction = 'asc';

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
        $testimonies = Testimony::with(['createdBy', 'updatedBy'])
            ->orderBy($this->sort_field, $this->sort_direction)->paginate(10);

        $data = [
            'testimonies' => $testimonies,
        ];

        return view('livewire.dashboard.testimony.testimony-index', $data)->layout('layouts.dashboard', [
            'header' => 'Testimonies'
        ]);
    }

    public function updateStatus($id, $status)
    {
        $testimony = Testimony::find($id);
        if ($testimony) {
            $testimony->update(['status' => $status, 'updated_by' => auth()->id()]);

            $this->dispatch('alert-success', title: 'Testimony Status Successfully Updated!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Update Testimony Status');
        }
    }

    public function delete($id)
    {
        $testimony = Testimony::destroy($id);
        if ($testimony) {
            $this->dispatch('alert-success', title: 'Testimony Successfully Deleted!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Delete Testimony');
        }
    }
}
