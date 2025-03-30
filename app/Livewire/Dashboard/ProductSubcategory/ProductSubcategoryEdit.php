<?php

namespace App\Livewire\Dashboard\ProductSubcategory;

use App\Models\ProductSubcategory;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductSubcategoryEdit extends Component
{
    public $product_subcategory;
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
        $this->reset('product_subcategory');
        $this->reset('product_category_id');
        $this->reset('title');
        $this->resetValidation();
    }

    #[On('edited')]
    public function edited($id)
    {
        $product_subcategory = ProductSubcategory::find($id);

        $this->product_subcategory = $product_subcategory;
        $this->product_category_id = $product_subcategory->product_category_id;
        $this->title               = $product_subcategory->title;

        $this->dispatch('open-modal', name: 'edit-product-subcategory-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.product-subcategory.product-subcategory-edit');
    }

    public function store()
    {
        $product_subcategory = $this->product_subcategory;

        $validated = $this->validate([
            'product_category_id' => ['required'],
            'title' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use($product_subcategory) {
                    if (ProductSubcategory::where('slug', Str::slug($value))->where('id', '!=', $product_subcategory->id)->exists()) {
                        $fail('The title must be unique.');
                    }
                }
            ],
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['updated_by'] = auth()->id();

        try {
            $product_subcategory->update($validated);

            $this->dispatch('product-subcategory-edited');
            $this->dispatch('close-modal', name: 'edit-product-subcategory-modal');
            $this->dispatch('alert-success', title: 'Product Subcategory Successfully Edited!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Edit Product Subcategory');
        }
    }
}
