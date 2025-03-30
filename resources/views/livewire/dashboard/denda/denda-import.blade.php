<div>
    <form wire:submit="store" class="px-0.5">
        <div class="flex justify-between items-center mb-4">
            <label class="block text-sm font-medium text-gray-900 dark:text-white">
                Upload file
            </label>

            <!-- Button Check (Digeser ke kanan) -->
            <a wire:click="checkData" type="submit" 
               class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-150 ml-auto">
                Check
            </a>
        </div>
        <div class="mb-4">
            <label for="month_year" class="block text-sm font-medium text-gray-900 dark:text-white">Select Month & Year</label>
            <input type="month" id="monemployeeImportthYear" wire:model="selectedMonthYear" 
                class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>
        <div class="">
            <input wire:model="employeeImport" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="employeeImport" id="file_input" type="file">
            
            <!-- Show file name when uploaded -->
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300" wire:loading.remove wire:target="employeeImport">
                Selected file: <span class="font-semibold" wire:loading.remove wire:target="employeeImport">{{ $employeeImport ? $employeeImport->getClientOriginalName() : 'No file selected' }}</span>
            </p>
    
            <!-- Show loading text while uploading -->
            <p class="mt-2 text-sm text-indigo-600 dark:text-indigo-400" wire:loading wire:target="employeeImport">
                Uploading...
            </p>
        </div>
        @if ($stat == 1)
        <div class="flex space-x-4 mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">
                <x-icon-loading wire:loading.delay wire:target="store" class="w-4 h-4 fill-indigo-600 text-gray-200 animate-spin"></x-icon-loading>
                {{ __('Save') }}
            </button>
            
        </div>
        @endif
        @if (!empty($errors))
            <div class="mt-4 p-4 bg-red-100 text-red-700 rounded">
                <h3 class="font-semibold">Error:</h3>
                <ul class="list-disc list-inside">
                    @foreach ($errors as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </form>
</div>
