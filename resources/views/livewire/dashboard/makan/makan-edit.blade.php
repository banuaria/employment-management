<div>
    <form wire:submit="store" class="px-0.5">
         <!-- NIK -->
         <div>
            <x-input-label for="total-edit" :value="__('Uang Makan')" />
            <x-text-input wire:model="total" id="total-edit" class="block mt-1 w-full" type="number" name="total" autofocus autocomplete="total" />
            <x-input-error :messages="$errors->get('total')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="total-mel-edit" :value="__('Uang MEL')" />
            <x-text-input wire:model="total_mel" id="total-mel-edit" class="block mt-1 w-full" type="number" name="total_mel" autofocus autocomplete="total_mel" />
            <x-input-error :messages="$errors->get('total_mel')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="total-unit-edit" :value="__('Uang Unit')" />
            <x-text-input wire:model="total_unit" id="total-unit-edit" class="block mt-1 w-full" type="number" name="total_unit" autofocus autocomplete="total_unit" />
            <x-input-error :messages="$errors->get('total_unit')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="total-loading-edit" :value="__('Uang Loading')" />
            <x-text-input wire:model="total_loading" id="total-loading-edit" class="block mt-1 w-full" type="number" name="total_loading" autofocus autocomplete="total_loading" />
            <x-input-error :messages="$errors->get('total_loading')" class="mt-2" />
        </div>
        <div class="flex space-x-4 mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">
                <x-icon-loading wire:loading.delay wire:target="store" class="w-4 h-4 fill-indigo-600 text-gray-200 animate-spin"></x-icon-loading>
                {{ __('Save') }}
            </button>
        </div>
    </form>
</div>
