<div>
    <form wire:submit="store" class="px-0.5">
        <!-- Name -->
        <div>
            <x-input-label for="name-user-create" :value="__('Name')" />
            <x-text-input wire:model="name" id="name-user-create" class="block mt-1 w-full" type="text" name="name" autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Area Code Address -->
        <div class="mt-4">
            <x-input-label for="area-user-create" :value="__('Area Code')" />
            <x-text-input wire:model="area" id="area-user-create" class="block mt-1 w-full" type="text" name="area" autocomplete="area" />
            <x-input-error :messages="$errors->get('area')" class="mt-2" />
        </div>

         <!-- UMK  -->
         <div class="mt-4">
            <x-input-label for="umk-user-create" :value="__('UMK')" />
            <x-text-input wire:model="umk" id="umk-user-create" class="block mt-1 w-full" type="number" name="umk" autocomplete="umk" />
            <x-input-error :messages="$errors->get('umk')" class="mt-2" />
        </div>

        <div class="flex space-x-4 mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">
                <x-icon-loading wire:loading.delay wire:target="store" class="w-4 h-4 fill-indigo-600 text-gray-200 animate-spin"></x-icon-loading>
                {{ __('Save') }}
            </button>
        </div>
    </form>
</div>
