<?php

namespace App\Livewire\Dashboard\Product;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductPhoto;
use App\Models\ProductSubcategory;
use App\Models\ProductTag;
use App\Models\Store;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductCreate extends Component
{
    public $product_categories = [];
    public $product_category_id = '';
    public $product_subcategories = [];
    public $product_subcategory_id = '';
    public $product_tags = [];
    public $product_tag_ids = [];
    public $product_photo_paths = [];
    public $product_photo_max = 3;
    public $stores_default = [];
    public $stores = [];
    public $product_stores = [];
    public $thumbnail = '';
    public $title = '';
    public $content = '';
    public $usage = '';
    public $meta_title = '';
    public $meta_desc = '';
    public $meta_keywords = '';

    #[On('tinymce-textarea')]
    public function tinymceTextarea($value, $textareaId)
    {
        if ($textareaId === '1') {
            $this->content = $value;
        } else if ($textareaId === '2') {
            $this->usage = $value;
        }
    }

    #[On('select2-select')]
    public function select2select($values, $selectId)
    {
        if ($selectId === '1') {
            $this->product_tag_ids = $values;
        }
    }

    #[On('listen-filemanager-picker')]
    public function filemanagerPicker($property, $path)
    {
        if ($property === 'thumbnail') {
            $this->thumbnail = $path;
        } else if ($property === 'product_photo_paths') {
            $this->product_photo_paths[] = $path;
        }
    }

    public function resetFilemanagerPicker($property, $key = null)
    {
        if ($property === 'thumbnail') {
            $this->thumbnail = null;
        } else if ($property === 'product_photo_paths') {
            $this->product_photo_paths = Arr::except($this->product_photo_paths, [$key]);
        }
    }

    #[On('product-store-created')]
    public function productStoreCreated($store_id, $url)
    {
        $this->product_stores[$store_id] = [
            'url' => $url,
        ];
        $this->stores = Arr::except($this->stores, [$store_id]);
    }

    #[On('product-store-deleted')]
    public function productStoreDeleted($key, $store_title)
    {
        $this->product_stores = Arr::except($this->product_stores, [$key]);
        $this->stores[$key] = $store_title;
    }

    public function updatedProductCategoryId()
    {
        $this->product_subcategories = ProductSubcategory::where('product_category_id', $this->product_category_id)->pluck('title', 'id');
        $this->product_tags = ProductTag::where('product_category_id', $this->product_category_id)->pluck('title', 'id');
        $this->reset('product_subcategory_id');
        $this->reset('product_tag_ids');
    }

    public function mount()
    {
        $this->product_categories = ProductCategory::pluck('title', 'id');
        $this->stores_default = Store::pluck('title', 'id');
        $this->stores = $this->stores_default;
    }

    public function render()
    {
        return view('livewire.dashboard.product.product-create')->layout('layouts.dashboard', [
            'header' => 'Product Create'
        ]);
    }

    public function store()
    {
        $validated = $this->validate([
            'product_category_id'    => ['required'],
            'product_subcategory_id' => ['required'],
            'product_tag_ids'        => ['nullable', 'array'],
            'product_photo_paths'    => ['nullable', 'array'],
            'product_stores'         => ['nullable', 'array'],
            'thumbnail'              => ['required', 'string', 'max:255'],
            'title'                  => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (Product::where('slug', Str::slug($value))->exists()) {
                        $fail('The title must be unique.');
                    }
                }
            ],
            'content'                => ['required', 'string'],
            'usage'                  => ['required', 'string'],
            'meta_title'             => ['nullable', 'string', 'max:255'],
            'meta_desc'              => ['nullable', 'string', 'max:255'],
            'meta_keywords'          => ['nullable', 'string', 'max:255'],
        ]);

        $validated = array_map(function ($value) {
            return $value === '' ? null : $value;
        }, $validated);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        try {
            $product = Product::create($validated);

            $product->productTags()->sync($validated['product_tag_ids']);

            foreach ($validated['product_photo_paths'] as $path) {
                ProductPhoto::create([
                    'product_id' => $product->id,
                    'path'       => $path
                ]);
            }

            $product->productStores()->sync($validated['product_stores']);

            $this->dispatch('alert-success', title: 'Product Successfully Created!', redirect: '/cms/product-edit/'.$product->id);
        } catch (\Exception $e) {
            $this->dispatch('alert-failure', title: 'Failed to Create Product');
        }
    }
}
