<div>
    <form wire:submit="store" class="px-0.5">
        <div>
            <x-input-label for="location-category-id-location-create" :value="__('Category')" />
            <select wire:model="location_category_id" id="location-category-id-location-create" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="" disabled selected>Select Category</option>
                @if (count($location_categories) > 0)
                    @foreach ($location_categories as $key => $location_category)
                        <option value="{{ $key }}">{{ $location_category }}</option>
                    @endforeach
                @endif
            </select>
            <x-input-error :messages="$errors->get('location_category_id')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="name-location-create" :value="__('Name')" />
            <x-text-input wire:model="name" id="name-location-create" class="block mt-1 w-full" type="text" name="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="address-location-create" :value="__('Address')" />
            <x-textarea-input wire:model="address" id="address-location-create" class="block mt-1 w-full" type="text" name="address" rows="3"></x-textarea-input>
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email-location-create" :value="__('Email')" />
            <x-text-input wire:model="email" id="email-location-create" class="block mt-1 w-full" type="text" name="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="phone-location-create" :value="__('Phone')" />
            <x-text-input wire:model="phone" id="phone-location-create" class="block mt-1 w-full" type="text" name="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="mobile-location-create" :value="__('Mobile')" />
            <x-text-input wire:model="mobile" id="mobile-location-create" class="block mt-1 w-full" type="text" name="mobile" />
            <x-input-error :messages="$errors->get('mobile')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="fax-location-create" :value="__('Fax')" />
            <x-text-input wire:model="fax" id="fax-location-create" class="block mt-1 w-full" type="text" name="fax" />
            <x-input-error :messages="$errors->get('fax')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="detail-location-create" :value="__('Detail')" />
            <x-text-input wire:model="detail" id="detail-location-create" class="block mt-1 w-full" type="text" name="detail" />
            <x-input-error :messages="$errors->get('detail')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label class="mb-2" for="desc-location-create" :value="__('Description')" />
            <div wire:ignore>
                <x-textarea-input wire:model.change="desc" id="desc-location-create" class="block mt-1 w-full tinymce-textarea" tinymce-textarea-id="1" type="text" name="desc" rows="3"></x-textarea-input>
            </div>
            <x-input-error :messages="$errors->get('desc')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="country-location-create" :value="__('Country')" />
            <x-text-input wire:model="country" id="country-location-create" class="block mt-1 w-full" type="text" name="country" />
            <x-input-error :messages="$errors->get('country')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="province-location-create" :value="__('Province')" />
            <x-text-input wire:model="province" id="province-location-create" class="block mt-1 w-full" type="text" name="province" />
            <x-input-error :messages="$errors->get('province')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="city-location-create" :value="__('City')" />
            <x-text-input wire:model="city" id="city-location-create" class="block mt-1 w-full" type="text" name="city" />
            <x-input-error :messages="$errors->get('city')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="latitude-location-create" :value="__('Latitude')" />
            <x-text-input wire:model="latitude" id="latitude-location-create" class="block mt-1 w-full" type="text" name="latitude" />
            <x-input-error :messages="$errors->get('latitude')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="longitude-location-create" :value="__('Longitude')" />
            <x-text-input wire:model="longitude" id="longitude-location-create" class="block mt-1 w-full" type="text" name="longitude" />
            <x-input-error :messages="$errors->get('longitude')" class="mt-2" />
        </div>

        <div class="flex space-x-4 mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">
                <x-icon-loading wire:loading.delay wire:target="store" class="w-4 h-4 fill-indigo-600 text-gray-200 animate-spin"></x-icon-loading>
                {{ __('Save') }}
            </button>
        </div>
    </form>
</div>
