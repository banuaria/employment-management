<?php

namespace App\Livewire\Dashboard\Store;

use App\Models\Store;
use Livewire\Attributes\On;
use Livewire\Component;

class StoreCreate extends Component
{
    public $title = '';
    public $path = '';
    public $url = '';

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    #[On('listen-filemanager-picker')]
    public function filemanagerPicker($property, $path)
    {
        if ($property === 'path') {
            $this->path = $path;
        }
    }

    public function resetFilemanagerPicker($property)
    {
        if ($property === 'path') {
            $this->path = null;
        }
    }

    #[On('created')]
    public function created()
    {
        $this->dispatch('open-modal', name: 'create-store-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.store.store-create');
    }

    public function store()
    {
        $validated = $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'path'  => ['required', 'string', 'max:255'],
            'url'   => ['required', 'string', 'max:255'],
        ]);

        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        try {
            Store::create($validated);

            $this->dispatch('store-created');
            $this->dispatch('close-modal', name: 'create-store-modal');
            $this->dispatch('alert-success', title: 'Store Successfully Created!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Create Store');
        }
    }
}
