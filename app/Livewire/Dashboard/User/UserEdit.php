<?php

namespace App\Livewire\Dashboard\User;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class UserEdit extends Component
{
    public $user;
    public string $name = '';
    public string $email = '';
    public string $role = '';

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    #[On('edited')]
    public function edited($id)
    {
        $user = User::find($id);

        $this->user  = $user;
        $this->name  = $user->name;
        $this->email = $user->email;
        $this->role  = $user->getRoleNames()->first();

        $this->dispatch('open-modal', name: 'edit-user-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.user.user-edit');
    }

    public function store()
    {
        $user = $this->user;

        $validated = $this->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'role'  => ['required', 'string'],
        ]);

        $user->update($validated);

        if ($user->getRoleNames()->first() !== $validated['role']) {
            $user->removeRole($user->getRoleNames()->first());
            $user->assignRole($validated['role']);
        }

        if ($user) {
            $this->dispatch('user-edited');
            $this->dispatch('close-modal', name: 'edit-user-modal');
            $this->dispatch('alert-success', title: 'User Successfully Edited!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Edit User');
        }
    }
}
