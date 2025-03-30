<?php

namespace App\Livewire\Dashboard\ProductTag;

use App\Models\ProductTag;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductTagEdit extends Component
{
    public $product_tag;
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
        $this->reset('product_tag');
        $this->reset('product_category_id');
        $this->reset('title');
        $this->resetValidation();
    }

    #[On('edited')]
    public function edited($id)
    {
        $product_tag = ProductTag::find($id);

        $this->product_tag         = $product_tag;
        $this->product_category_id = $product_tag->product_category_id;
        $this->title               = $product_tag->title;

        $this->dispatch('open-modal', name: 'edit-product-tag-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.product-tag.product-tag-edit');
    }

    public function store()
    {
        $product_tag = $this->product_tag;

        $validated = $this->validate([
            'product_category_id' => ['required'],
            'title' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use($product_tag) {
                    if (ProductTag::where('slug', Str::slug($value))->where('id', '!=', $product_tag->id)->exists()) {
                        $fail('The title must be unique.');
                    }
                }
            ],
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['updated_by'] = auth()->id();

        try {
            $product_tag->update($validated);

            $this->dispatch('product-tag-edited');
            $this->dispatch('close-modal', name: 'edit-product-tag-modal');
            $this->dispatch('alert-success', title: 'Product Tag Successfully Edited!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Edit Product Tag');
        }
    }
}
