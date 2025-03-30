<?php

namespace App\Livewire\Dashboard\ProductSubcategory;

use App\Models\ProductSubcategory;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductSubcategoryCreate extends Component
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
        $this->dispatch('open-modal', name: 'create-product-subcategory-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.product-subcategory.product-subcategory-create');
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
                    if (ProductSubcategory::where('slug', Str::slug($value))->exists()) {
                        $fail('The title must be unique.');
                    }
                }
            ],
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        try {
            ProductSubcategory::create($validated);

            $this->dispatch('product-subcategory-created');
            $this->dispatch('close-modal', name: 'create-product-subcategory-modal');
            $this->dispatch('alert-success', title: 'Product Subcategory Successfully Created!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Create Product Subcategory');
        }
    }
}
