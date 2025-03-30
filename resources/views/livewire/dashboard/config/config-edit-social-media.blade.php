<div>
    <form wire:submit="store" class="px-0.5">
        <!-- Instagram -->
        <div>
            <x-input-label for="instagram-config-edit-social-media" :value="__('Instagram')" />
            <x-text-input wire:model="instagram" id="instagram-config-edit-social-media" class="block mt-1 w-full" type="text" name="instagram" />
            <x-input-error :messages="$errors->get('instagram')" class="mt-2" />
        </div>

        <!-- Facebook -->
        <div class="mt-4">
            <x-input-label for="facebook-config-edit-social-media" :value="__('Facebook')" />
            <x-text-input wire:model="facebook" id="facebook-config-edit-social-media" class="block mt-1 w-full" type="text" name="facebook" />
            <x-input-error :messages="$errors->get('facebook')" class="mt-2" />
        </div>

        <!-- X -->
        <div class="mt-4">
            <x-input-label for="x-config-edit-social-media" :value="__('X')" />
            <x-text-input wire:model="x" id="x-config-edit-social-media" class="block mt-1 w-full" type="text" name="x" />
            <x-input-error :messages="$errors->get('x')" class="mt-2" />
        </div>

        <!-- LinkedIn -->
        <div class="mt-4">
            <x-input-label for="linkedin-config-edit-social-media" :value="__('LinkedIn')" />
            <x-text-input wire:model="linkedin" id="linkedin-config-edit-social-media" class="block mt-1 w-full" type="text" name="linkedin" />
            <x-input-error :messages="$errors->get('linkedin')" class="mt-2" />
        </div>

        <!-- Youtube -->
        <div class="mt-4">
            <x-input-label for="youtube-config-edit-social-media" :value="__('Youtube')" />
            <x-text-input wire:model="youtube" id="youtube-config-edit-social-media" class="block mt-1 w-full" type="text" name="youtube" />
            <x-input-error :messages="$errors->get('youtube')" class="mt-2" />
        </div>

        <!-- Tiktok -->
        <div class="mt-4">
            <x-input-label for="tiktok-config-edit-social-media" :value="__('Tiktok')" />
            <x-text-input wire:model="tiktok" id="tiktok-config-edit-social-media" class="block mt-1 w-full" type="text" name="tiktok" />
            <x-input-error :messages="$errors->get('tiktok')" class="mt-2" />
        </div>

        <div class="flex space-x-4 mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">
                <x-icon-loading wire:loading.delay wire:target="store" class="w-4 h-4 fill-indigo-600 text-gray-200 animate-spin"></x-icon-loading>
                {{ __('Save') }}
            </button>
        </div>
    </form>
</div>
