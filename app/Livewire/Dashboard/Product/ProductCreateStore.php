<?php

namespace App\Livewire\Dashboard\Product;

use Livewire\Attributes\On;
use Livewire\Component;

class ProductCreateStore extends Component
{
    public $stores = [];
    public $store_id = '';
    public $url = '';

    public function validationAttributes()
    {
        $attributes = [];
        $attributes["store_id"] = 'store';
        return $attributes;
    }

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset('store_id');
        $this->reset('url');
        $this->resetValidation();
    }

    #[On('created')]
    public function created()
    {
        $this->dispatch('open-modal', name: 'create-store-product-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.product.product-create-store');
    }

    public function store()
    {
        $validated = $this->validate([
            'store_id' => ['required'],
            'url'      => ['required', 'string', 'max:255'],
        ]);

        $this->dispatch('product-store-created', store_id: $validated['store_id'], url: $validated['url']);
        $this->dispatch('close-modal', name: 'create-store-product-modal');
    }
}
