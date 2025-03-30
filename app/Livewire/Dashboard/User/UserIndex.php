<?php

namespace App\Livewire\Dashboard\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;

    #[Url(as: 'role', except: '')]
    public string $role = '';
    #[Url(as: 'q', except: '')]
    public string $search = '';
    #[Url(as: 'sort', except: 'created_at')]
    public string $sort_field = 'created_at';
    #[Url(as: 'direction', except: 'asc')]
    public string $sort_direction = 'asc';

    public function updatingRole()
    {
        $this->resetPage();
    }

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
        $users = User::when($this->role !== '', fn (Builder $query) => $query->role($this->role))
            ->when($this->search !== '', fn (Builder $query) => $query->where('name', 'like', '%'. $this->search .'%')->orWhere('email', 'like', '%'. $this->search .'%'))
            ->orderBy($this->sort_field, $this->sort_direction)
            ->paginate(10);

        $data = [
            'users' => $users,
        ];

        return view('livewire.dashboard.user.user-index', $data)->layout('layouts.dashboard', [
            'header' => 'Users'
        ]);
    }

    public function updateStatus($id, $status)
    {
        $user = User::find($id);
        if ($user) {
            $user->update(['status' => $status]);

            $this->dispatch('alert-success', title: 'User Status Successfully Updated!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Update User Status');
        }
    }

    public function delete($id)
    {
        $user = User::destroy($id);
        if ($user) {
            $this->dispatch('alert-success', title: 'User Successfully Deleted!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Delete User');
        }
    }
}
