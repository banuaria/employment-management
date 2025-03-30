<div>
    @if ($configData->cover_product)
    <img class="w-full h-auto bg-cover bg-center" src="{{ $configData->cover_product }}" alt="image description">
    @endif
    
    <div class="w-full m-auto max-w-screen-xl px-5 py-12">
        <div class="flex flex-row flex-wrap justify-between items-center">
            <x-title-section title="Our Products" mainTitle="{{ $product_category->title }}"/>
            @if (count($product_tags) > 0)
            <div class="relative w-full max-w-48">
                <select wire:model.live.debounce.250ms="product_tag_slug" class="block w-full p-2 text-sm text-gray-900 border border-gray-300 bg-white focus:ring-primary-500 focus:border-primary-500">
                    <option value="all" selected>Select Category</option>
                    @foreach ($product_tags as $slug => $tag)
                        <option value="{{ $slug }}">{{ $tag }}</option>
                    @endforeach
                </select>
            </div>
            @endif
        </div>
        <div class="flex flex-col lg:flex-row items-start space-x-0 lg:space-x-8 space-y-8 lg:space-y-0">
            <div class="w-full lg:w-3/12 bg-gray-100 p-8">
                <div class="flex flex-col space-y-4">
                    <div wire:click='setActive("all")' class="font-bold uppercase cursor-pointer {{ $product_subcategory_slug == 'all' ? 'text-black' : 'text-gray-500' }}">
                        All
                    </div>
                    @foreach ($product_subcategories as $slug => $category)
                    <div wire:click='setActive("{{ $slug }}")' class="font-bold uppercase cursor-pointer {{ $product_subcategory_slug == $slug ? 'text-black' : 'text-gray-500' }}">
                        {{ $category }}
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="w-full lg:w-9/12">      
                @if (count($products) > 0)
                    <div class="relative grid grid-cols-2 md:grid-cols-3 gap-4 lg:gap-8">
                        @foreach ($products as $product)
                            <x-product-card 
                                thumbnail="{{ $product->thumbnail }}"
                                category="{{ $product->productCategory->title }}"
                                title="{{ $product->title }}"
                                ctaLink="{{ route('product.detail', ['slug_category' => $product->productCategory->slug, 'slug_subcategory' => $product->productSubcategory->slug, 'slug' => $product->slug]) }}"
                                ctaText="View Detail"
                                :ctaTargetBlank="false"
                            />
                        @endforeach
                    </div>
                    <div class="{{ $products->hasPages() ? 'mt-4' : '' }}">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="px-4 py-3 text-center">No Product Found</div>
                @endif
            </div>
        </div>
    </div>
</div>