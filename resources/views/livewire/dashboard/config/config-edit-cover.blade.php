<div>
    <form wire:submit="store" class="px-0.5">
        <div>
            <div class="bg-yellow-50 text-xs text-yellow-700 py-3 px-3 rounded-md mb-4">
                <p>Perhatian :</p>
                <p>- Maksimum filesize di sarankan dibawah 100kb.</p>
                <p>- Dimensi Cover Banner di sarankan 1440x420 px</p>
                <p>Catatan :</p>
                <p>Mengubah filesize dan dimensi foto akan mempengaruhi performa pada website, pastikan file tetap di bawah 100kb.</p>
                <div class="">
                    <a class="inline-flex bg-green-100 hover:bg-green-200 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded mt-2" href="https://tinypng.com/" target="_blank">
                        Tools online untuk mengkompres filesize image
                        <x-icon-link class="h-3 w-3 ms-1"/>
                    </a>
                </div>
            </div>
            <x-input-label for="cover-about-config-edit-cover" :value="__('Cover About')" />
            <div class="my-1 px-11 py-4 relative flex justify-center border border-gray-200 rounded-md shadow-sm">
                @if (!$cover_about)
                <x-icon-image wire:click="$dispatch('filemanager-picker', { to: 'dashboard.config.config-edit-cover', filetype: 'image', property: 'cover_about' })" class="absolute top-1 left-2 w-7 h-7 text-gray-300 cursor-pointer"></x-icon-image>
                @endif
                <div class="relative w-full h-auto">
                    @if ($cover_about)
                    <img src="{{ asset($cover_about) }}" class="w-full h-full object-cover" />
                    <div wire:click="resetFilemanagerPicker('cover_about')" class="absolute -top-2.5 -right-2.5 bg-white rounded-full">
                        <x-icon-remove class="w-6 h-6 text-red-600 cursor-pointer" />
                    </div>
                    @else
                    <div class="h-1"></div>
                    @endif
                </div>
            </div>
            <x-input-error :messages="$errors->get('cover_about')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="cover-product-config-edit-cover" :value="__('Cover Product')" />
            <div class="my-1 px-11 py-4 relative flex justify-center border border-gray-200 rounded-md shadow-sm">
                @if (!$cover_product)
                <x-icon-image wire:click="$dispatch('filemanager-picker', { to: 'dashboard.config.config-edit-cover', filetype: 'image', property: 'cover_product' })" class="absolute top-1 left-2 w-7 h-7 text-gray-300 cursor-pointer"></x-icon-image>
                @endif
                <div class="relative w-full h-auto">
                    @if ($cover_product)
                    <img src="{{ asset($cover_product) }}" class="w-full h-full object-cover" />
                    <div wire:click="resetFilemanagerPicker('cover_product')" class="absolute -top-2.5 -right-2.5 bg-white rounded-full">
                        <x-icon-remove class="w-6 h-6 text-red-600 cursor-pointer" />
                    </div>
                    @else
                    <div class="h-1"></div>
                    @endif
                </div>
            </div>
            <x-input-error :messages="$errors->get('cover_product')" class="mt-2" />
        </div>

        <div class="flex space-x-4 mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">
                <x-icon-loading wire:loading.delay wire:target="store" class="w-4 h-4 fill-indigo-600 text-gray-200 animate-spin"></x-icon-loading>
                {{ __('Save') }}
            </button>
        </div>
    </form>
</div>
