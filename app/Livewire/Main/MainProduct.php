<?php

namespace App\Livewire\Main;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use App\Models\ProductTag;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class MainProduct extends Component
{
    use WithPagination;

    public $product_category;
    public $product_subcategories = [];
    public $product_tags = [];

    public $per_page = 12;

    #[Url(as: 'product', except: 'all')]
    public string $product_subcategory_slug = 'all';
    #[Url(as: 'category', except: 'all')]
    public string $product_tag_slug = 'all';
    #[Url(as: 'sort', except: 'created_at')]
    public string $sort_field = 'created_at';
    #[Url(as: 'direction', except: 'desc')]
    public string $sort_direction = 'desc';

    public function updating($property)
    {
        if ($property === 'product_subcategory_slug' || $property === 'product_tag_slug') {
            $this->resetPage();
        }
    }

    public function sortBy($field)
    {
        if ($this->sort_field === $field) {
            $this->sort_direction = $this->sort_direction === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sort_field = $field;
            $this->sort_direction = 'desc';
        }
        $this->resetPage();
    }

    public function mount($slug_category)
    {
        $this->product_category = ProductCategory::where('slug', $slug_category)->first();
        $this->product_subcategories = ProductSubcategory::where('product_category_id', $this->product_category->id)->pluck('title', 'slug');
        $this->product_tags = ProductTag::where('product_category_id', $this->product_category->id)->pluck('title', 'slug');
    }

    public function render()
    {
        $products = Product::with(['productCategory', 'createdBy'])
            ->when($this->product_subcategory_slug !== 'all', function ($query) {
                $query->whereHas('productSubcategory', fn (Builder $subQuery) => $subQuery->where('slug', $this->product_subcategory_slug))->with('productSubcategory');
            })
            ->when($this->product_tag_slug !== 'all', function ($query) {
                $query->whereHas('productTags', fn (Builder $tagQuery) => $tagQuery->where('slug', $this->product_tag_slug))->with('productTags');
            })
            ->active()
            ->where('product_category_id', $this->product_category->id)
            ->orderBy($this->sort_field, $this->sort_direction)->paginate($this->per_page);

        $data = [
            'products' => $products,
        ];
        
        return view('livewire.main.main-product', $data)->layout('layouts.main');
    }

    public function setActive($slug)
    {
        $this->product_subcategory_slug = $slug;
    }
}
