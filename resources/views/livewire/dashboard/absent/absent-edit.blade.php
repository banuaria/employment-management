<div>
    <form wire:submit="store" class="px-0.5">
        
         <!-- NIK -->
         <div>
            <x-input-label for="absent-edit" :value="__('Total Absent')" />
            <x-text-input wire:model="absent" id="absent-edit" class="block mt-1 w-full" type="number" name="absent" autofocus autocomplete="nik" />
            <x-input-error :messages="$errors->get('absent')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="absent-bonus-edit" :value="__('Total Bonus Absent')" />
            <x-text-input wire:model="bonus_absent" id="absent-bonus-edit" class="block mt-1 w-full" type="number" name="bonus_absent" autofocus autocomplete="nik" />
            <x-input-error :messages="$errors->get('bonus_absent')" class="mt-2" />
        </div>

        <div class="flex space-x-4 mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">
                <x-icon-loading wire:loading.delay wire:target="store" class="w-4 h-4 fill-indigo-600 text-gray-200 animate-spin"></x-icon-loading>
                {{ __('Save') }}
            </button>
        </div>
    </form>
</div>
