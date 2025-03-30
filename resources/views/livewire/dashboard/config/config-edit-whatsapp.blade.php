<div>
    <form wire:submit="store" class="px-0.5">
        <!-- Whatsapp Phone -->
        <div>
            <x-input-label for="whatsapp-phone-config-edit-integration" :value="__('Whatsapp Phone')" />
            <x-text-input wire:model="whatsapp_phone" id="whatsapp-phone-config-edit-integration" class="block mt-1 w-full" type="text" name="whatsapp_phone" />
            <x-input-error :messages="$errors->get('whatsapp_phone')" class="mt-2" />
        </div>

        <!-- Whatsapp Message -->
        <div class="mt-4">
            <x-input-label for="whatsapp-message-config-edit-integration" :value="__('Whatsapp Message')" />
            <x-text-input wire:model="whatsapp_message" id="whatsapp-message-config-edit-integration" class="block mt-1 w-full" type="text" name="whatsapp_message" />
            <x-input-error :messages="$errors->get('whatsapp_message')" class="mt-2" />
        </div>

        <!-- Whatsapp Float -->
        <div class="mt-4">
            <x-input-label for="whatsapp-float-config-edit-integration" :value="__('Whatsapp Float')" />
            <div class="mt-2">
                <label class="relative cursor-pointer">
                    <input wire:model="whatsapp_float" value="{{ $whatsapp_float }}" {{ $whatsapp_float ? 'checked' : ''}} id="whatsapp-float-config-edit-integration" class="sr-only peer" type="checkbox" name="whatsapp_float">
                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                </label>
            </div>
            <x-input-error :messages="$errors->get('whatsapp_float')" class="mt-2" />
        </div>

        <div class="flex space-x-4 mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">
                <x-icon-loading wire:loading.delay wire:target="store" class="w-4 h-4 fill-indigo-600 text-gray-200 animate-spin"></x-icon-loading>
                {{ __('Save') }}
            </button>
        </div>
    </form>
</div>
