<nav class="bg-white border-gray-200">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-5">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <x-application-logo logo="{{ $configData->primary_logo ? asset($configData->primary_logo) : '' }}" class="h-10" />
        </a>
    </div>
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl px-5 py-2.5">
        <button data-collapse-toggle="mega-menu-full-image" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-700 md:hidden hover:text-gray-500" aria-controls="mega-menu-full-image" aria-expanded="false">
            <svg id="menu-icon" class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"></path>
            </svg>
            <svg id="close-icon" class="hidden w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <div class="flex md:order-2">
            <x-search></x-search>
        </div>
        <div id="mega-menu-full-image" class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1">
            <ul class="flex flex-col mt-4 font-medium md:flex-row md:mt-0 md:space-x-8 rtl:space-x-reverse">
                <li>
                    <a href="{{ route('main') }}" class="block py-2 px-3 {{ request()->routeIs('main') ? 'text-primary-500 ' : 'text-gray-900' }} hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-primary-600 md:p-0" aria-current="page">HOME</a>
                </li>
                {{-- @foreach ($product_categories as $category)
                <li>
                    <button id="mega-menu-button" data-collapse-toggle="mega-menu-dropdown" data-index="{{ $loop->index }}" class="mega-menu-button flex items-center justify-between w-full py-2 px-3 font-medium {{ request()->routeIs('product.*') && request()->route('slug_category') === $category->slug ? 'text-primary-500 ' : 'text-gray-900' }} md:w-auto hover:bg-gray-50 md:hover:bg-transparent md:border-0 hover:text-primary-600 md:p-0 focus:text-primary-600 uppercase">
                        {{ $category->title }}
                        <div class="md:hidden">
                            <svg aria-hidden="true" class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06 0L10 10.93l3.71-3.72a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 010-1.06z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </button>
                    <div id="mega-menu-dropdown" data-index="{{ $loop->index }}" class="hidden group-hover:block mega-menu-dropdown md:absolute text-white z-50 w-full left-0 shadow-sm py-4">
                        <div class="flex bg-white md:bg-black max-w-screen-xl px-4 py-4 mx-auto text-sm md:px-6">
                            <div class="md:flex w-full py-5 space-x-6">
                                <div class="lg:w-1/2 hidden md:block">
                                    @if ($category->cover)    
                                    <img src="{{ $category->cover }}" alt="{{ $category->title }}">
                                    @endif
                                </div>
                                <div class="w-1/2">
                                    <h2 class="text-lg font-semibold text-black md:text-white md:text-xl">Products</h2>
                                    <ul class="flex flex-col mt-2 space-y-2">
                                       @foreach ($category->productSubcategories as $subcategory)
                                        <li><a href="{{ route('product.category', [
                                            'slug_category' => $category->slug, 
                                            'product' => $subcategory->slug,
                                            'category' => 'all'
                                        ]) }}" class="text-black md:text-white hover:text-primary-400 capitalize">{{ ucfirst($subcategory->title) }}</a></li>
                                        @endforeach 
                                    </ul>
                                </div>
                                <div class="w-1/2 mt-5 md:m-0">
                                    <h2 class="text-lg font-semibold text-black md:text-white md:text-xl">Categories</h2>
                                    <ul class="flex flex-col mt-2 space-y-2">
                                        @foreach ($category->productTags as $tag)
                                        <li><a href="{{ route('product.category', [
                                            'slug_category' => $category->slug, 
                                            'product' => 'all',
                                            'category' => $tag->slug
                                        ]) }}" class="text-black md:text-white hover:text-primary-400 capitalize">{{ ucfirst($tag->title) }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach --}}
                <li>
                    <a href="{{ route('post.index') }}" class="block py-2 px-3 {{ request()->routeIs('post.index') || request()->routeIs('post.detail') ? 'text-primary-500 ' : 'text-gray-900' }} hover:bg-gray-50 md:hover:bg-transparent md:border-0 hover:text-primary-600 md:p-0" aria-current="page">HIGHLIGHTS</a>
                </li>
            </ul>
        </div>
    </div>
    
</nav>
<script>
    document.querySelectorAll('.mega-menu-button').forEach(button => {
        button.addEventListener('mouseenter', function() {
            const index = this.getAttribute('data-index');
            const dropdown = document.querySelector(`.mega-menu-dropdown[data-index="${index}"]`);
            dropdown.classList.remove('hidden');
        });

        button.addEventListener('mouseleave', function() {
            const index = this.getAttribute('data-index');
            const dropdown = document.querySelector(`.mega-menu-dropdown[data-index="${index}"]`);
            dropdown.classList.add('hidden');
        });
    });

    document.querySelectorAll('.mega-menu-dropdown').forEach(dropdown => {
        dropdown.addEventListener('mouseenter', function() {
            this.classList.remove('hidden');
        });

        dropdown.addEventListener('mouseleave', function() {
            this.classList.add('hidden');
        });
    });
</script>