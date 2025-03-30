<div>
    <form wire:submit="store" class="px-0.5">
        <div>
            <x-input-label for="product-category-id-product-subcategory-edit" :value="__('Category')" />
            <select wire:model="product_category_id" id="product-category-id-product-subcategory-edit" disabled class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="" disabled selected>Select Category</option>
                @if (count($product_categories) > 0)
                    @foreach ($product_categories as $key => $product_category)
                        <option value="{{ $key }}">{{ $product_category }}</option>
                    @endforeach
                @endif
            </select>
            <x-input-error :messages="$errors->get('product_category_id')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="name-product-subcategory-edit" :value="__('Title')" />
            <x-text-input wire:model="title" id="name-product-subcategory-edit" class="block mt-1 w-full" type="text" name="title" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <div class="flex space-x-4 mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">
                <x-icon-loading wire:loading.delay wire:target="store" class="w-4 h-4 fill-indigo-600 text-gray-200 animate-spin"></x-icon-loading>
                {{ __('Save') }}
            </button>
        </div>
    </form>
</div>
