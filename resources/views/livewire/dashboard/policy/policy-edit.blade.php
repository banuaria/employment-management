<div>
    <form wire:submit="store" class="px-0.5">
        <div>
            <x-input-label class="mb-2" for="content-policy-edit" :value="__('Content')" />
            <div wire:ignore>
                <x-textarea-input wire:model.change="content" id="content-policy-edit" class="block mt-1 w-full tinymce-textarea" tinymce-textarea-id="1" type="text" name="content" rows="3"></x-textarea-input>
            </div>
            <x-input-error :messages="$errors->get('content')" class="mt-2" />
        </div>

        <div class="flex space-x-4 mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">
                <x-icon-loading wire:loading.delay wire:target="store" class="w-4 h-4 fill-indigo-600 text-gray-200 animate-spin"></x-icon-loading>
                {{ __('Save') }}
            </button>
        </div>
    </form>
</div>
