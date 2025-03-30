<div>
    <form wire:submit="store" class="px-0.5">
        <!-- Name -->
        <div>
            <x-input-label for="name-user-edit" :value="__('Name')" />
            <x-text-input wire:model="name" id="name-user-edit" class="block mt-1 w-full" type="text" name="name" autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email-user-edit" :value="__('Email')" />
            <x-text-input wire:model="email" id="email-user-edit" class="block mt-1 w-full" type="email" name="email" autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role-user-edit" :value="__('Role')" />
            <select wire:model="role" id="role-user-edit" class="block mt-1 w-full border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="" disabled selected>Select Role</option>
                <option value="admin">Admin</option>
                <option value="editor">Editor</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div class="flex space-x-4 mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">
                <x-icon-loading wire:loading.delay wire:target="store" class="w-4 h-4 fill-indigo-600 text-gray-200 animate-spin"></x-icon-loading>
                {{ __('Save') }}
            </button>
        </div>
    </form>
</div>
