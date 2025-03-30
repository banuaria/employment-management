<?php

namespace App\Livewire\Dashboard\ProductTag;

use App\Models\ProductTag;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductTagCreate extends Component
{
    public $product_categories = [];
    public $product_category_id = '';
    public $title = '';

    public function validationAttributes()
    {
        $attributes = [];
        $attributes["product_category_id"] = 'category';
        return $attributes;
    }

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset('product_category_id');
        $this->reset('title');
        $this->resetValidation();
    }

    #[On('created')]
    public function created()
    {
        $this->dispatch('open-modal', name: 'create-product-tag-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.product-tag.product-tag-create');
    }

    public function store()
    {
        $validated = $this->validate([
            'product_category_id' => ['required'],
            'title' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (ProductTag::where('slug', Str::slug($value))->exists()) {
                        $fail('The title must be unique.');
                    }
                }
            ],
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        try {
            ProductTag::create($validated);

            $this->dispatch('product-tag-created');
            $this->dispatch('close-modal', name: 'create-product-tag-modal');
            $this->dispatch('alert-success', title: 'Product Tag Successfully Created!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Create Product Tag');
        }
    }
}
