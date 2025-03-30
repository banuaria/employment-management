<div>
    <div class="w-full m-auto max-w-screen-xl px-5 py-12">
        <div class="flex flex-row flex-wrap font-bold uppercase space-x-1">
            <a href="{{ route('main') }}" class="text-gray-500 hover:text-black">
                <span>Home</span>
            </a>
            <span class="text-gray-500">/</span>
            <a href="{{ route('product.category', ['slug_category' => $product->productCategory->slug, 'product' => 'all', 'category' => 'all']) }}" class="text-gray-500 hover:text-black">
                <span>{{ $product->productCategory->title }}</span>
            </a>
            <span class="text-gray-500">/</span>
            <a href="{{ route('product.category', ['slug_category' => $product->productCategory->slug, 'product' => $product->productSubcategory->slug, 'category' => 'all']) }}" class="text-gray-500 hover:text-black">
                <span>{{ $product->productSubcategory->title }}</span>
            </a>
            <span class="text-gray-500">/</span>
            <span class="text-black">{{ $product->title }}</span>
        </div>
        <div class="mt-12 flex flex-col lg:flex-row space-y-8 lg:space-y-0 space-x-0 lg:space-x-8">
            <div class="lg:w-5/12">
                @if (count($product->productPhotos) > 0)
                <div class="flex flex-col space-y-4">
                    <section id="splide-carousel-main" class="splide" aria-label="{{ $product->title }}">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @foreach ($product->productPhotos as $photo)
                                <li class="splide__slide w-full aspect-square border">
                                    <img src="{{ asset($photo->path) }}" alt="{{ $product->title }}" class="w-full h-full object-contain">
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </section>
                    <section id="splide-carousel-thumbnail" class="splide px-16" aria-label="{{ $product->title }}">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @foreach ($product->productPhotos as $photo)
                                <li class="splide__slide w-full aspect-square border">
                                    <img src="{{ asset($photo->path) }}" alt="{{ $product->title }}" class="w-full h-full object-contain">
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </section>
                </div>
                @else
                <div class="w-full aspect-square">
                    <img src="{{ asset('images/default/thumbnail.png') }}" class="w-full h-full object-cover" alt="{{ $product->title }}" />
                </div>
                @endif
            </div>
            <div class="lg:w-7/12">
                <div class="flex flex-col space-y-4 mb-4">
                    <h1 class="text-2xl md:text-4xl font-extrabold mb-4 uppercase">{{ $product->title }}</h1>
                    <div class="text-gray-700 text-base line-clamp-5 mb-3">
                        <p>{!! $product->content !!}</p>
                    </div>
                    @if ($product->productStores->isNotEmpty())
                    <div x-data="{ open: false }">
                        <x-primary-button @click="open = !open" :outline="true" class="text-nowrap">BUY NOW</x-primary-button>

                        <div x-show="open" 
                            x-transition:enter="transition ease-out duration-300" 
                            x-transition:enter-start="opacity-0 scale-90" 
                            x-transition:enter-end="opacity-100 scale-100" 
                            x-transition:leave="transition ease-in duration-200" 
                            x-transition:leave-start="opacity-100 scale-100" 
                            x-transition:leave-end="opacity-0 scale-90" 
                            class="mt-4 p-4">
                            <div class="flex flex-row flex-wrap">
                                @foreach ($product->productStores as $store)
                                    <a href="{{ $store->pivot->url }}" target="_blank">
                                        <img class="h-16 w-auto max-w-full rounded-lg" src="{{ $store->path }}" alt="{{ $store->title }}">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="mt-12">
            <div class="mb-4 overflow-hidden uppercase">
                <ul class="flex -mb-px text-sm font-medium text-center overflow-x-auto" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist" data-tabs-active-classes="border-red-500 border-b-2 text-red-500 hover:text-red-500">
                    <li class="relative mr-12" role="presentation">
                        <button class="inline-block px-8 py-4 text-2xl font-bold text-nowrap border-b-2" id="content-tab" data-tabs-target="#content" type="button" role="tab" aria-controls="content" aria-selected="false">Description</button>
                    </li>
                    <li class="relative mr-12" role="presentation">
                        <button class="inline-block px-8 py-4 text-2xl font-bold text-nowrap border-b-2 hover:text-gray-600 hover:border-gray-300" id="usage-tab" data-tabs-target="#usage" type="button" role="tab" aria-controls="usage" aria-selected="false">How To Use</button>
                    </li>
                </ul>
            </div>
            <div id="default-tab-content">
                <div class="hidden py-4 rounded-lg" id="content" role="tabpanel" aria-labelledby="content-tab">
                    <div>
                        <div class="tinymce-content">{!! $product->content !!}</div>
                    </div>
                </div>
                <div class="hidden py-4 rounded-lg" id="usage" role="tabpanel" aria-labelledby="usage-tab">
                    <div>
                        <div class="tinymce-content">{!! $product->usage !!}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-12">
            <h3 class="text-xl font-bold mb-4">Related Products</h3>
            <div class="relative grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-8">
                @foreach ($related_products as $product)
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
        </div>
    </div>
</div>
  