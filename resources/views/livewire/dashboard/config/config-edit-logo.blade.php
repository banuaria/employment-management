<div>
    <form wire:submit="store" class="px-0.5">
        <!-- Primary Logo -->
        <div class="bg-yellow-50 text-xs text-yellow-700 py-3 px-3 rounded-md mb-4">
            <p>Perhatian :</p>
            <p>- Maksimum filesize di sarankan dibawah 100kb.</p>
            <p>Catatan :</p>
            <p>Mengubah filesize dan dimensi foto akan mempengaruhi performa pada website, pastikan file tetap di bawah 100kb.</p>
            <div class="">
                <a class="inline-flex bg-green-100 hover:bg-green-200 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded mt-2" href="https://tinypng.com/" target="_blank">
                    Tools online untuk mengkompres filesize image
                    <x-icon-link class="h-3 w-3 ms-1"/>
                </a>
            </div>
        </div>
        <div>
            <x-input-label for="primary-logo-config-edit-logo" :value="__('Primary Logo')" />
            <div class="my-1 px-11 py-4 relative flex justify-center border border-gray-200 rounded-md shadow-sm">
                @if (!$primary_logo)
                <x-icon-image wire:click="$dispatch('filemanager-picker', { to: 'dashboard.config.config-edit-logo', filetype: 'image', property: 'primary_logo' })" class="absolute top-1 left-2 w-7 h-7 text-gray-300 cursor-pointer"></x-icon-image>
                @endif
                <div class="relative">
                    <x-application-logo logo="{{ $primary_logo ? asset($primary_logo) : '' }}" />
                    @if ($primary_logo)
                    <div wire:click="resetFilemanagerPicker('primary_logo')" class="absolute -top-2.5 -right-2.5 bg-white rounded-full">
                        <x-icon-remove class="w-6 h-6 text-red-600 cursor-pointer" />
                    </div>
                    @endif
                </div>
            </div>
            <x-input-error :messages="$errors->get('primary_logo')" class="mt-2" />
        </div>

        <!-- Secondary Logo -->
        <div class="mt-4">
            <x-input-label for="secondary-logo-config-edit-logo" :value="__('Secondary Logo')" />
            <div class="my-1 px-11 py-4 relative flex justify-center border border-gray-200 rounded-md shadow-sm">
                @if (!$secondary_logo)
                <x-icon-image wire:click="$dispatch('filemanager-picker', { to: 'dashboard.config.config-edit-logo', filetype: 'image', property: 'secondary_logo' })" class="absolute top-1 left-2 w-7 h-7 text-gray-300 cursor-pointer"></x-icon-image>
                @endif
                <div class="relative">
                    <x-application-logo logo="{{ $secondary_logo ? asset($secondary_logo) : '' }}" />
                    @if ($secondary_logo)
                    <div wire:click="resetFilemanagerPicker('secondary_logo')" class="absolute -top-2.5 -right-2.5 bg-white rounded-full">
                        <x-icon-remove class="w-6 h-6 text-red-600 cursor-pointer" />
                    </div>
                    @endif
                </div>
            </div>
            <x-input-error :messages="$errors->get('secondary_logo')" class="mt-2" />
        </div>

        <!-- Favicon -->
        <div class="mt-4">
            <x-input-label for="favicon-config-edit-logo" :value="__('Favicon')" />
            <div class="my-1 px-11 py-4 relative flex justify-center border border-gray-200 rounded-md shadow-sm">
                @if (!$favicon)
                <x-icon-image wire:click="$dispatch('filemanager-picker', { to: 'dashboard.config.config-edit-logo', filetype: 'image', property: 'favicon' })" class="absolute top-1 left-2 w-7 h-7 text-gray-300 cursor-pointer"></x-icon-image>
                @endif
                <div class="relative">
                    <img src="{{ $favicon ? asset($favicon) : asset('images/default/favicon.png') }}" class="h-8">
                    @if ($favicon)
                    <div wire:click="resetFilemanagerPicker('favicon')" class="absolute -top-2.5 -right-2.5 bg-white rounded-full">
                        <x-icon-remove class="w-6 h-6 text-red-600 cursor-pointer" />
                    </div>
                    @endif
                </div>
            </div>
            <x-input-error :messages="$errors->get('favicon')" class="mt-2" />
        </div>

        <div class="flex space-x-4 mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">
                <x-icon-loading wire:loading.delay wire:target="store" class="w-4 h-4 fill-indigo-600 text-gray-200 animate-spin"></x-icon-loading>
                {{ __('Save') }}
            </button>
        </div>
    </form>
</div>
