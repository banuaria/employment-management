<?php

namespace App\Livewire\Main;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class MainProductDetail extends Component
{
    public $product;
    public $related_products;

    public function mount($slug) 
    {
        $this->product = Product::where('slug', $slug)->firstOrFail();
        $category = $this->product->productCategory;
        $related_products = Product::with(['productCategory', 'productSubcategory', 'productTags', 'createdBy'])->when($category != null, fn (Builder $query) => $query->whereHas('productCategory', function($q) use($category) {
                $q->where('id', $category->id);
            }))
            ->active()
            ->where('id', '!=', $this->product->id)
            ->limit(4)
            ->get();
        if (count($related_products) < 4) {
            $remaining = 4 - count($related_products);
            $related_product_ids = $related_products->pluck('id');
            $related_product_ids[] = $this->product->id;
            $remaining_products = Product::with(['productCategory', 'productSubcategory', 'productTags', 'createdBy'])
                ->active()
                ->whereNotIn('id', $related_product_ids)
                ->limit($remaining)
                ->get();
            $this->related_products = $related_products->concat($remaining_products);
        } else {
            $this->related_products = $related_products;
        }
    }

    public function render()
    {
        return view('livewire.main.main-product-detail')->layout('layouts.main');
    }
}
