<div>
    <form wire:submit="store" class="px-0.5">
        <div>
            <x-input-label for="path-cover-edit" :value="__('Cover')" />
            <div class="my-1 px-11 py-4 relative flex justify-center border border-gray-200 rounded-md shadow-sm">
                @if (!$path)
                <x-icon-image wire:click="$dispatch('filemanager-picker', { to: 'dashboard.cover.cover-edit', filetype: 'image', property: 'path' })" class="absolute top-1 left-2 w-7 h-7 text-gray-300 cursor-pointer"></x-icon-image>
                @endif
                <div class="relative w-full h-auto">
                    @if ($path)
                    <img src="{{ asset($path) }}" class="w-full h-full object-cover" />
                    <div wire:click="resetFilemanagerPicker('path')" class="absolute -top-2.5 -right-2.5 bg-white rounded-full">
                        <x-icon-remove class="w-6 h-6 text-red-600 cursor-pointer" />
                    </div>
                    @else
                    <img src="{{ asset('images/default/cover.png') }}" class="w-full h-full object-cover" />
                    @endif
                </div>
            </div>
            <x-input-error :messages="$errors->get('path')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="url-cover-edit" :value="__('Url')" />
            <x-text-input wire:model="url" id="url-cover-edit" class="block mt-1 w-full" type="text" name="url" />
            <x-input-error :messages="$errors->get('url')" class="mt-2" />
        </div>

        <div class="flex space-x-4 mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">
                <x-icon-loading wire:loading.delay wire:target="store" class="w-4 h-4 fill-indigo-600 text-gray-200 animate-spin"></x-icon-loading>
                {{ __('Save') }}
            </button>
        </div>
    </form>
</div>
