<?php

namespace App\Livewire\Dashboard\Store;

use App\Models\Store;
use Livewire\Attributes\On;
use Livewire\Component;

class StoreEdit extends Component
{
    public $store;
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

    #[On('edited')]
    public function edited($id)
    {
        $store = Store::find($id);

        $this->store = $store;
        $this->title = $store->title;
        $this->path  = $store->path;
        $this->url   = $store->url;

        $this->dispatch('open-modal', name: 'edit-store-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.store.store-edit');
    }

    public function store()
    {
        $store = $this->store;

        $validated = $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'path'  => ['required', 'string', 'max:255'],
            'url'   => ['required', 'string', 'max:255'],
        ]);

        $validated['updated_by'] = auth()->id();

        try {
            $store->update($validated);

            $this->dispatch('store-edited');
            $this->dispatch('close-modal', name: 'edit-store-modal');
            $this->dispatch('alert-success', title: 'Store Successfully Edited!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Edit Store');
        }
    }
}
