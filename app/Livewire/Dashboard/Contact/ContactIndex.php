<?php

namespace App\Livewire\Dashboard\Contact;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ContactIndex extends Component
{
    use WithPagination;

    #[Url(as: 'q', except: '')]
    public string $search = '';
    #[Url(as: 'sort', except: 'created_at')]
    public string $sort_field = 'created_at';
    #[Url(as: 'direction', except: 'desc')]
    public string $sort_direction = 'desc';

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
        $contacts = Contact::when($this->search !== '', fn (Builder $query) => $query->where('name', 'like', '%'. $this->search .'%')->orWhere('email', 'like', '%'. $this->search .'%')->orWhere('phone', 'like', '%'. $this->search .'%')->orWhere('subject', 'like', '%'. $this->search .'%'))
            ->orderBy($this->sort_field, $this->sort_direction)
            ->paginate(10);

        $data = [
            'contacts' => $contacts,
        ];

        return view('livewire.dashboard.contact.contact-index', $data)->layout('layouts.dashboard', [
            'header' => 'Contacts'
        ]);
    }

    public function delete($id)
    {
        $contact = Contact::destroy($id);
        if ($contact) {
            $this->dispatch('alert-success', title: 'Contact Successfully Deleted!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Delete Contact');
        }
    }
}
