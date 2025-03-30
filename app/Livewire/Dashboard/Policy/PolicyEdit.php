<?php

namespace App\Livewire\Dashboard\Policy;

use App\Models\Policy;
use Livewire\Attributes\On;
use Livewire\Component;

class PolicyEdit extends Component
{
    public $policy;
    public $content;

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    #[On('tinymce-textarea')]
    public function tinymceTextarea($value, $textareaId)
    {
        if ($textareaId === '1') {
            $this->content = $value;
        }
    }

    #[On('edited')]
    public function edited()
    {
        $policy = Policy::first();

        $this->policy  = $policy;
        $this->content = $policy->content;

        $this->dispatch('modal-refresh');
        $this->dispatch('open-modal', name: 'edit-policy-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.policy.policy-edit');
    }

    public function store()
    {
        $policy = $this->policy;

        $validated = $this->validate([
            'content' => ['nullable', 'string'],
        ]);

        $validated = array_map(function ($value) {
            return $value === '' ? null : $value;
        }, $validated);

        $validated['updated_by'] = auth()->id();

        try {
            $policy->update($validated);

            $this->dispatch('policy-edited');
            $this->dispatch('close-modal', name: 'edit-policy-modal');
            $this->dispatch('alert-success', title: 'Privacy Policy Successfully Edited!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Edit Privacy Policy');
        }
    }
}
