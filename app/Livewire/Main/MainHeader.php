<?php

namespace App\Livewire\Main;

use App\Models\ProductCategory;
use Livewire\Component;

class MainHeader extends Component
{
    public $keywords;

    public function render()
    {
        // $product_categories = ProductCategory::with(['productSubcategories'])->active()->get();
        // $data = [
        //     'product_categories' => $product_categories,
        // ];

        return view('livewire.main.main-header');
    }

    public function search()
    {   if($this->keywords !== null){
            return redirect()->route('search', ['keywords' => $this->keywords]);
        }else{
            return redirect()->route('post.index');
        }
    }
}
