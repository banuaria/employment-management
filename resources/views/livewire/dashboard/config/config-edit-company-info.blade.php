<div>
    <form wire:submit="store" class="px-0.5">
        <!-- Company Name -->
        <div>
            <x-input-label for="company-name-config-edit-company-info" :value="__('Company Name')" />
            <x-text-input wire:model="company_name" id="company-name-config-edit-company-info" class="block mt-1 w-full" type="text" name="company_name" />
            <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address-config-edit-company-info" :value="__('Address')" />
            <x-textarea-input wire:model="address" id="address-config-edit-company-info" class="block mt-1 w-full" type="text" name="address" rows="3"></x-textarea-input>
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email-config-edit-company-info" :value="__('Email')" />
            <x-text-input wire:model="email" id="email-config-edit-company-info" class="block mt-1 w-full" type="text" name="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone-config-edit-company-info" :value="__('Phone')" />
            <x-text-input wire:model="phone" id="phone-config-edit-company-info" class="block mt-1 w-full" type="text" name="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Mobile -->
        <div class="mt-4">
            <x-input-label for="mobile-config-edit-company-info" :value="__('Mobile')" />
            <x-text-input wire:model="mobile" id="mobile-config-edit-company-info" class="block mt-1 w-full" type="text" name="mobile" />
            <x-input-error :messages="$errors->get('mobile')" class="mt-2" />
        </div>

        <!-- Fax -->
        <div class="mt-4">
            <x-input-label for="fax-config-edit-company-info" :value="__('Fax')" />
            <x-text-input wire:model="fax" id="fax-config-edit-company-info" class="block mt-1 w-full" type="text" name="fax" />
            <x-input-error :messages="$errors->get('fax')" class="mt-2" />
        </div>

        <div class="flex space-x-4 mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">
                <x-icon-loading wire:loading.delay wire:target="store" class="w-4 h-4 fill-indigo-600 text-gray-200 animate-spin"></x-icon-loading>
                {{ __('Save') }}
            </button>
        </div>
    </form>
</div>
