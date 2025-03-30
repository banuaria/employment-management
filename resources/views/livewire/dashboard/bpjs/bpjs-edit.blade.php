<div>
    <form wire:submit="store" class="px-0.5">
         <div>
            <x-input-label for="jht-edit" :value="__('JHT')" />
            <x-text-input wire:model="jht" id="jht-edit" class="block mt-1 w-full" type="number" name="jht" autofocus autocomplete="jht" />
            <x-input-error :messages="$errors->get('jht')" class="mt-2" />
        </div>
        <!-- JKM -->
          <div>
            <x-input-label for="jkm-edit" :value="__('JKM')" />
            <x-text-input wire:model="jkm" id="jkm-edit" class="block mt-1 w-full" type="number" name="jkm" autofocus autocomplete="jkm" />
            <x-input-error :messages="$errors->get('jkm')" class="mt-2" />
        </div>
        <!-- JP -->
        <div>
            <x-input-label for="jp-edit" :value="__('JP')" />
            <x-text-input wire:model="jp" id="jp-edit" class="block mt-1 w-full" type="number" name="jp" autofocus autocomplete="jp" />
            <x-input-error :messages="$errors->get('jp')" class="mt-2" />
        </div>
        <!-- KES -->
        <div>
            <x-input-label for="kes-edit" :value="__('KES')" />
            <x-text-input wire:model="kes" id="kes-edit" class="block mt-1 w-full" type="number" name="kes" autofocus autocomplete="kes" />
            <x-input-error :messages="$errors->get('kes')" class="mt-2" />
        </div>
        <div class="flex space-x-4 mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">
                <x-icon-loading wire:loading.delay wire:target="store" class="w-4 h-4 fill-indigo-600 text-gray-200 animate-spin"></x-icon-loading>
                {{ __('Save') }}
            </button>
        </div>
    </form>
</div>
