<div>
    <form wire:submit="store" class="px-0.5">
        <div class="mt-4">
            <x-input-label for="month-absent-create" :value="__('Select Month & Year')" />
            <label for="month_year" class="block text-sm font-medium text-gray-900 dark:text-white"></label>
            <input type="month" id="monthYear" wire:model="selectedMonthYear" 
                class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>
         <!-- NIK -->
         <div class="mt-4">
            <x-input-label for="nik-absent-create" :value="__('NIK')" />
            <x-text-input wire:model="nik" id="name-absent-create" class="block mt-1 w-full" type="number" name="nik" autofocus autocomplete="nik" />
            <x-input-error :messages="$errors->get('nik')" class="mt-2" />
        </div>

          <!-- vendor -->
        <div class="mt-4">
            <x-input-label for="vendor-employee-create" :value="__('Vendor')" />
            <select wire:model="vendor_id" id="vendor-employee-create" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="" disabled selected>Select Vendor</option>
                @foreach ($vendor as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('area_id')" class="mt-2" />
        </div>
        
        <!-- status -->
        <div class="mt-4">
            <x-input-label for="status-absent-create" :value="__('Status')" />
            <select wire:model="status" id="status-absent-create" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="" disabled selected>Select Status</option>
                <option value="1">REGULER</option>
                <option value="2">LOADING</option>
                <option value="3">HARIAN</option>
            </select>
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>

        <!-- Absent -->
        <div class="mt-4">
            <x-input-label for="absent-absent-create" :value="__('Absent')" />
            <x-text-input wire:model="absent" id="absent-absent-create" class="block mt-1 w-full" type="number" name="absent" autofocus autocomplete="absent" />
            <x-input-error :messages="$errors->get('absent')" class="mt-2" />
        </div>

         <!--Bonus Absent -->
         <div class="mt-4">
            <x-input-label for="bonus-absent-create" :value="__('Bonus Absent')" />
            <x-text-input wire:model="bonus_absent" id="bonus-absent-create" class="block mt-1 w-full" type="number" name="bonus_absent" autofocus autocomplete="bonus_absent" />
            <x-input-error :messages="$errors->get('bonus_absent')" class="mt-2" />
        </div>
        <div class="flex space-x-4 mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">
                <x-icon-loading wire:loading.delay wire:target="store" class="w-4 h-4 fill-indigo-600 text-gray-200 animate-spin"></x-icon-loading>
                {{ __('Save') }}
            </button>
        </div>
    </form>
</div>
