<?php

namespace App\Livewire\Dashboard\ProductCategory;

use App\Models\ProductCategory;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductCategoryCreate extends Component
{
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

    #[On('created')]
    public function created()
    {
        $this->dispatch('open-modal', name: 'create-product-category-modal');
    }

    public function render()
    {
        return view('livewire.dashboard.product-category.product-category-create');
    }

    public function store()
    {
        $validated = $this->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (ProductCategory::where('slug', Str::slug($value))->exists()) {
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
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        try {
            ProductCategory::create($validated);

            $this->dispatch('product-category-created');
            $this->dispatch('close-modal', name: 'create-product-category-modal');
            $this->dispatch('alert-success', title: 'Product Category Successfully Created!');
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Create Product Category');
        }
    }
}
