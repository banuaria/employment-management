<?php

namespace App\Livewire\Main;

use App\Models\ProductCategory;
use Livewire\Component;

class MainFooter extends Component
{
    public function render()
    {
        // $product_categories = ProductCategory::with(['productSubcategories'])->active()->get();
        // $links = [];
        // $links[] = [
        //     'title' => 'About Us',
        //     'route' => route('about'),
        // ];
        // foreach ($product_categories as $category) {
        //     $links[] = [
        //         'title' => ucfirst($category->title),
        //         'route' => route('product.category', [
        //             'slug_category' => $category->slug, 
        //             'product' => 'all',
        //             'category' => 'all'
        //         ]),
        //     ];
        // }
        // $links[] = [
        //     'title' => 'Highlights',
        //     'route' => route('post.index'),
        // ];
        // $links[] = [
        //     'title' => 'Store',
        //     'route' => route('store'),
        // ];
        // $links[] = [
        //     'title' => 'Contact',
        //     'route' => route('contact'),
        // ];
        // $links[] = [
        //     'title' => 'FAQ',
        //     'route' => route('faq'),
        // ];
        // $links[] = [
        //     'title' => 'Privacy Policy',
        //     'route' => route('policy'),
        // ];
        // $links[] = [
        //     'title' => 'Terms & Conditions',
        //     'route' => route('term'),
        // ];

        // $data = [
        //     'link_chunks' => array_chunk($links, 4),
        // ];

        return view('livewire.main.main-footer');
    }
}
