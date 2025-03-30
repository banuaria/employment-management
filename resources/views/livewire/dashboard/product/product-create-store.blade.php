<div>
    <form wire:submit="store" class="px-0.5">
        <div>
            <x-input-label for="store-id-product-create-store" :value="__('Store')" />
            <select wire:model="store_id" id="store-id-product-create-store" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="" disabled selected>Select Store</option>
                @if (count($stores) > 0)
                    @foreach ($stores as $key => $store)
                        <option value="{{ $key }}">{{ $store }}</option>
                    @endforeach
                @endif
            </select>
            <x-input-error :messages="$errors->get('store_id')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="url-product-create-store" :value="__('Url')" />
            <x-text-input wire:model="url" id="url-product-create-store" class="block mt-1 w-full" type="text" name="url" />
            <x-input-error :messages="$errors->get('url')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-8">
        <div class="flex space-x-4 mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">
                <x-icon-loading wire:loading.delay wire:target="store" class="w-4 h-4 fill-indigo-600 text-gray-200 animate-spin"></x-icon-loading>
                {{ __('Save') }}
            </button>
        </div>
        </div>
    </form>
</div>
