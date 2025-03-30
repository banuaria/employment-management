<?php

namespace App\Livewire\Dashboard\ProductCategory;

use App\Models\ProductCategory;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductCategoryEdit extends Component
{
    public $product_category;
    public $title = '';
    public $cover = '';

    #[On('close-modal')]
    public function closeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    #[On('listen-filemanager-picker')]
    public function filemanagerPicker($property, $path)
    {
        if ($property === 'cover') {
            $this->cover = $path;
        }
    }

    public function resetFilemanagerPicker($property)
    {
        if ($property === 'cover') {
            $this->cover = null;
        }
    }

    #[On('edited')]
    public function edited($id)
    {
        $product_category = ProductCategory::find($id);

        $this->product_category = $product_category;
        $this->title            = $product_category->title;
        $this->cover            = $product_category->cover;

        $this->dispatch('open-modal', name: 'edit-product-category-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.product-category.product-category-edit');
    }

    public function store()
    {
        $product_category = $this->product_category;

        $validated = $this->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use($product_category) {
                    if (ProductCategory::where('slug', Str::slug($value))->where('id', '!=', $product_category->id)->exists()) {
                        $fail('The title must be unique.');
                    }
                }
            ],
            'cover' => ['nullable', 'string', 'max:255'],
        ]);

        $validated = array_map(function ($value) {
            return $value === '' ? null : $value;
        }, $validated);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['updated_by'] = auth()->id();

        try {
            $product_category->update($validated);

            $this->dispatch('product-category-edited');
            $this->dispatch('close-modal', name: 'edit-product-category-modal');
            $this->dispatch('alert-success', title: 'Product Category Successfully Edited!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Edit Product Category');
        }
    }
}
