<div>
    <form wire:submit="store" class="px-0.5">
        <!-- Head Tag -->
        <div>
            <x-input-label for="head-tag-config-edit-integration" :value="__('Head Tag')" />
            <x-textarea-input wire:model="head_tag" id="head-tag-config-edit-integration" class="block mt-1 w-full" type="text" name="head_tag" rows="5"></x-textarea-input>
            <x-input-error :messages="$errors->get('head_tag')" class="mt-2" />
        </div>

        <!-- Body Tag -->
        <div class="mt-4">
            <x-input-label for="body-tag-config-edit-integration" :value="__('Body Tag')" />
            <x-textarea-input wire:model="body_tag" id="body-tag-config-edit-integration" class="block mt-1 w-full" type="text" name="body_tag" rows="5"></x-textarea-input>
            <x-input-error :messages="$errors->get('body_tag')" class="mt-2" />
        </div>

        <!-- Google Map Tag -->
        <div class="mt-4">
            <x-input-label for="google-map-tag-config-edit-integration" :value="__('Google Map Tag')" />
            <x-textarea-input wire:model="google_map_tag" id="google-map-tag-config-edit-integration" class="block mt-1 w-full" type="text" name="google_map_tag" rows="5"></x-textarea-input>
            <x-input-error :messages="$errors->get('google_map_tag')" class="mt-2" />
        </div>

        <div class="flex space-x-4 mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">
                <x-icon-loading wire:loading.delay wire:target="store" class="w-4 h-4 fill-indigo-600 text-gray-200 animate-spin"></x-icon-loading>
                {{ __('Save') }}
            </button>
        </div>
    </form>
</div>
