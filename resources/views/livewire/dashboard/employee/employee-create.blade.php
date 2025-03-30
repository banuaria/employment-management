<div>
    <form wire:submit="store" class="px-0.5">
         <!-- NIK -->
         <div>
            <x-input-label for="nik-employee-create" :value="__('NIK')" />
            <x-text-input wire:model="nik" id="name-employee-create" class="block mt-1 w-full" type="text" name="nik" autofocus autocomplete="nik" />
            <x-input-error :messages="$errors->get('nik')" class="mt-2" />
        </div>
        <!-- Name -->
        <div>
            <x-input-label for="name-employee-create" :value="__('Name')" />
            <x-text-input wire:model="name" id="name-employee-create" class="block mt-1 w-full" type="text" name="name" autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <!-- Area -->
        <div class="mt-4">
            <x-input-label for="area-employee-create" :value="__('Area')" />
            <select wire:model="area_id" id="area-employee-create" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="" disabled selected>Select Area</option>
                @foreach ($areas as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('area_id')" class="mt-2" />
        </div>
        <!-- Client -->
        <div class="mt-4">
            <x-input-label for="client-employee-create" :value="__('Client')" />
            <select wire:model="client" id="client-employee-create" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="" disabled selected>Select Client</option>
                    <option value="Security">Security</option>
                    <option value="Office Boy">Office Boy</option>
                    <option value="Express">Express</option>
                    <option value="All Project">All Project</option>
                    <option value="Cargo">Cargo</option>
                    <option value="Shoppe">Shoppe</option>
                    <option value="Tomoro">Tomoro</option>
            </select>
            <x-input-error :messages="$errors->get('client')" class="mt-2" />
        </div>
        <!-- Join Date -->
        <div>
            <x-input-label for="join_date-employee-create" :value="__('Join Date')" />
            <x-text-input wire:model="join_date" id="join_date-employee-create" class="block mt-1 w-full" type="date" name="join_date" autofocus autocomplete="join_date" />
            <x-input-error :messages="$errors->get('join_date')" class="mt-2" />
        </div>
        <!-- Resign Date -->
        <div>
            <x-input-label for="resign_date-employee-create" :value="__('Resign Date')" />
            <x-text-input wire:model="resign_date" id="resign_date-employee-create" class="block mt-1 w-full" type="date" name="resign_date" autofocus autocomplete="resign_date" />
            <x-input-error :messages="$errors->get('resign_date')" class="mt-2" />
        </div>
        <!-- Status -->
        <div class="mt-4">
            <x-input-label for="status-employee-create" :value="__('Status')" />
            <select wire:model="status" id="status-employee-create" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="" disabled selected>Select Status</option>
                <option value="REGULER">REGULER</option>
                <option value="LOADING">LOADING</option>
                <option value="HARIAN">HARIAN</option>
            </select>
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>

        <div class="flex space-x-4 mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">
                <x-icon-loading wire:loading.delay wire:target="store" class="w-4 h-4 fill-indigo-600 text-gray-200 animate-spin"></x-icon-loading>
                {{ __('Save') }}
            </button>
        </div>
    </form>
</div>
