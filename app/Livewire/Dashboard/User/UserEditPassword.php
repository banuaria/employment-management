<?php

namespace App\Livewire\Dashboard\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Component;

class UserEditPassword extends Component
{
    public $user;
    public string $password = '';
    public string $password_confirmation = '';

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    #[On('password-edited')]
    public function passwordEdited($id)
    {
        $user = User::find($id);

        $this->user = $user;

        $this->dispatch('open-modal', name: 'edit-password-user-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.user.user-edit-password');
    }

    public function store()
    {
        $user = $this->user;

        try {
            $validated = $this->validate([
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('password', 'password_confirmation');

            throw $e;
        }

        $validated['password'] = Hash::make($validated['password']);

        $user->update($validated);

        if ($user) {
            $this->dispatch('user-password-edited');
            $this->dispatch('close-modal', name: 'edit-password-user-modal');
            $this->dispatch('alert-success', title: 'User Password Successfully Edited!');
        } else {
            $this->dispatch('alert-failure', title: 'Failed to Edit User Password');
        }
    }
}
