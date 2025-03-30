<div>
    <form wire:submit="store" class="px-0.5">
        <!-- Meta Title -->
        <div>
            <x-input-label for="meta-title-config-edit-meta-seo" :value="__('Meta Title')" />
            <x-text-input wire:model="meta_title" id="meta-title-config-edit-meta-seo" class="block mt-1 w-full" type="text" name="meta_title" />
            <x-input-error :messages="$errors->get('meta_title')" class="mt-2" />
        </div>

        <!-- Meta Description -->
        <div class="mt-4">
            <x-input-label for="meta-desc-config-edit-meta-seo" :value="__('Meta Description')" />
            <x-textarea-input wire:model="meta_desc" id="meta-desc-config-edit-meta-seo" class="block mt-1 w-full" type="text" name="meta_desc" rows="3"></x-textarea-input>
            <x-input-error :messages="$errors->get('meta_desc')" class="mt-2" />
        </div>

        <!-- Meta Keywords -->
        <div class="mt-4">
            <x-input-label for="meta-keywords-config-edit-meta-seo" :value="__('Meta Keywords')" />
            <x-text-input wire:model="meta_keywords" id="meta-keywords-config-edit-meta-seo" class="block mt-1 w-full" type="text" name="meta_keywords" />
            <x-input-error :messages="$errors->get('meta_keywords')" class="mt-2" />
        </div>

        <div class="flex space-x-4 mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">
                <x-icon-loading wire:loading.delay wire:target="store" class="w-4 h-4 fill-indigo-600 text-gray-200 animate-spin"></x-icon-loading>
                {{ __('Save') }}
            </button>
        </div>
    </form>
</div>
