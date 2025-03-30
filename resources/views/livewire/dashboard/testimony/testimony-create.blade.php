<div>
    <form wire:submit="store" class="px-0.5">
        <div>
            <x-input-label for="name-testimony-create" :value="__('Name')" />
            <x-text-input wire:model="name" id="name-testimony-create" class="block mt-1 w-full" type="text" name="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="profile-pic-testimony-create" :value="__('Profile Pic')" />
            <div class="my-1 px-11 py-4 relative flex justify-center border border-gray-200 rounded-md shadow-sm">
                @if (!$profile_pic)
                <x-icon-image wire:click="$dispatch('filemanager-picker', { to: 'dashboard.testimony.testimony-create', filetype: 'image', property: 'profile_pic' })" class="absolute top-1 left-2 w-7 h-7 text-gray-300 cursor-pointer"></x-icon-image>
                @endif
                <div class="relative w-16 h-16">
                    @if ($profile_pic)
                    <img src="{{ asset($profile_pic) }}" class="w-full h-full object-cover" />
                    <div wire:click="resetFilemanagerPicker('profile_pic')" class="absolute -top-2.5 -right-2.5 bg-white rounded-full">
                        <x-icon-remove class="w-6 h-6 text-red-600 cursor-pointer" />
                    </div>
                    @else
                    <img src="{{ asset('images/default/profile_pic.png') }}" class="w-full h-full object-cover" />
                    @endif
                </div>
            </div>
            <x-input-error :messages="$errors->get('profile_pic')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="designation-testimony-create" :value="__('Designation')" />
            <x-text-input wire:model="designation" id="designation-testimony-create" class="block mt-1 w-full" type="text" name="designation" />
            <x-input-error :messages="$errors->get('designation')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="content-testimony-create" :value="__('Content')" />
            <x-textarea-input wire:model="content" id="content-testimony-create" class="block mt-1 w-full" type="text" name="content" rows="3"></x-textarea-input>
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
