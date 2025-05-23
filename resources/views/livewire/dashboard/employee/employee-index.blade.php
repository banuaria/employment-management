<div class="py-12">
    <div class="sm:px-6 lg:px-8">
        <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
            <div class="w-full">
                <div class="flex justify-between items-center space-x-4 mb-4">
                    <div>
                        <button wire:click="$dispatch('open-modal', { name: 'create-employee-modal' })" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">Create employee</button>
                        <button wire:click="$dispatch('open-modal', { name: 'import-employee-modal' })" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">Import</button>
                        <button wire:click="export" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">Export</button>
                    </div>
                    <div class="flex-1 flex flex-col sm:flex-row justify-end items-end space-x-0 sm:space-x-2 space-y-2 sm:space-y-0">
                        <div class="relative w-full max-w-48">
                            <select wire:model.live.debounce.250ms="client" class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="" selected>Select Client</option>
                                <option value="SECURITY">Security</option>
                                <option value="OFFICE BOY">Office Boy</option>
                                <option value="EXPRESS">Express</option>
                                <option value="ALL PROJECT">All Project</option>
                                <option value="CARGO">Cargo</option>
                                <option value="SHOPEE">Shopee</option>
                                <option value="TOMORO">Tomoro</option>
                            </select>
                        </div>
                        <div class="relative w-full max-w-48">
                            <select wire:model.live.debounce.250ms="status" class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="" selected>Select Status</option>
                                <option value="1">REGULER</option>
                                <option value="2">LOADING</option>
                                <option value="3">HARIAN</option>
                            </select>
                        </div>
                        <div class="relative w-full max-w-48">
                            <select wire:model.live.debounce.250ms="selectedVendor" class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="" selected>Select Vendor</option>
                                @foreach ($vendors as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="relative w-full max-w-48">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <x-icon-search-outline class="w-3 h-5 text-gray-500"></x-icon-search-outline>
                            </div>
                            <input
                                wire:model.live.debounce.250ms="search"
                                type="text"
                                class="ps-8 block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Search employee"
                            />
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">No</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        NIK
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        Vendor
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Client</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        <a href="#" wire:click.prevent="sortBy('name')" class="flex justify-center items-center space-x-1">
                                            <div>Name</div>
                                            @if($sort_field == 'name')
                                                @if($sort_direction == 'asc')
                                                    <x-icon-caret-up class="w-4 h-4"></x-icon-caret-up>
                                                @else
                                                    <x-icon-caret-down class="w-4 h-4"></x-icon-caret-down>
                                                @endif
                                            @else
                                                <x-icon-caret-sort class="w-4 h-4 text-gray-300"></x-icon-caret-sort>
                                            @endif
                                        </a>
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        <a href="#" wire:click.prevent="sortBy('name')" class="flex justify-center items-center space-x-1">
                                            <div>Join Date</div>
                                            @if($sort_field == 'join_date')
                                                @if($sort_direction == 'asc')
                                                    <x-icon-caret-up class="w-4 h-4"></x-icon-caret-up>
                                                @else
                                                    <x-icon-caret-down class="w-4 h-4"></x-icon-caret-down>
                                                @endif
                                            @else
                                                <x-icon-caret-sort class="w-4 h-4 text-gray-300"></x-icon-caret-sort>
                                            @endif
                                        </a>
                                    </th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        <a href="#" wire:click.prevent="sortBy('name')" class="flex justify-center items-center space-x-1">
                                            <div>Resign Date</div>
                                            @if($sort_field == 'resign_date')
                                                @if($sort_direction == 'asc')
                                                    <x-icon-caret-up class="w-4 h-4"></x-icon-caret-up>
                                                @else
                                                    <x-icon-caret-down class="w-4 h-4"></x-icon-caret-down>
                                                @endif
                                            @else
                                                <x-icon-caret-sort class="w-4 h-4 text-gray-300"></x-icon-caret-sort>
                                            @endif
                                        </a>
                                    </th>
                                   
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Area</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Status</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($employMaster) > 0)
                                    @foreach ($employMaster as $key => $value)
                                    <tr class="bg-white border-b">
                                        <td class="px-4 py-3 border text-center w-0"><div class="py-1.5">{{ $employMaster->firstItem() + $key }}</div></td>
                                        <td class="px-4 py-3 border-r">{{ $value->nik }}</td>
                                        <td class="px-4 py-3 border-r uppercase">
                                          {{$value->vendors->name}}
                                        </td>
                                        <td class="px-4 py-3 border-r uppercase">{{ $value->client }}</td>    
                                        <td class="px-4 py-3 border-r uppercase">{{ $value->name }}</td>
                                        <td class="px-4 py-3 border-r">{{ $value->join_date ? \Carbon\Carbon::parse( $value->join_date )->translatedFormat('M d, Y') : '-'  }}</td>
                                        <td class="px-4 py-3 border-r">{{ $value->resign_date ? \Carbon\Carbon::parse( $value->resign_date )->translatedFormat('M d, Y') : '-'  }}</td>
                                    
                                        <td class="px-4 py-3 border-r">{{ $value->area->area }}</td>
                                        <td class="px-4 py-3 border-r">
                                            {{ $value->status_name }}
                                        </td>
                                        <td class="px-4 py-2 border-r w-0">
                                            <div class="flex justify-center items-center space-x-2">
                                                    {{-- <button wire:click="$dispatchTo('dashboard.employee.employee-edit-vendor', 'vendor-edited', { id: {{ $value->id }} })" type="button" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-500 active:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500"><x-icon-lock-time class="w-3.5 h-3.5"></x-icon-lock-time></button> --}}
                                                    <button wire:click="$dispatchTo('dashboard.employee.employee-edit', 'edited', { id: {{ $value->id }} })" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500"><x-icon-edit class="w-3.5 h-3.5"></x-icon-edit></button>
                                                    <button wire:click="$dispatch('alert-confirmation', { to: 'dashboard.employee.employee-index', data: { do: 'delete', 'id': {{ $value->id }} }, title: `Are you sure to delete {{ $value->name }}?` })" type="button" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-500 active:bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500"><x-icon-trash class="w-3.5 h-3.5"></x-icon-trash></button>
                                            
                                            </div>
                                        </td>
                                    </tr>
                                        {{-- @foreach ($value->vendors as $vendor)
                                        @endforeach --}}
                                    @endforeach
                                @else
                                    <tr class="bg-white border-b">
                                        <td colspan="100%" class="px-4 py-3 border text-center">No Data</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div wire:loading.delay class="absolute inset-x-0 inset-y-0 w-full h-full bg-gray-50 bg-opacity-50">
                        <div class="w-full h-full flex justify-center items-center">
                            <x-icon-loading class="w-6 h-6 fill-indigo-600 text-gray-200 animate-spin"></x-icon-loading>
                        </div>
                    </div>
                </div>
                <div class="{{ $employMaster->hasPages() ? 'mt-4' : '' }}">
                    {{ $employMaster->links() }}
                </div>
            </div>
        </div>
    </div>

    <x-modal name="import-employee-modal" closable="false" maxWidth="lg">
        <div class="flex justify-between items-start mb-4 space-x-4">
            <h4 class="font-semibold text-gray-600 pt-1 uppercase">
                Import employee
            </h4>
            <button
                wire:click="$dispatch('close-modal', { name: 'import-employee-modal' })"
                type="button"
                class="text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 p-2 rounded-full inline-flex items-center"
            >
                <x-icon-close class="w-4 h-4"></x-icon-close>
            </button>
        </div>
        <div class="flex-1 overflow-auto x-modal-content">
            <livewire:dashboard.employee.employee-import @employeeImported="$refresh" />
        </div>
    </x-modal>

    <x-modal name="create-employee-modal" closable="false" maxWidth="lg">
        <div class="flex justify-between items-start mb-4 space-x-4">
            <h4 class="font-semibold text-gray-600 pt-1 uppercase">
                Create employee
            </h4>
            <button
                wire:click="$dispatch('close-modal', { name: 'create-employee-modal' })"
                type="button"
                class="text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 p-2 rounded-full inline-flex items-center"
            >
                <x-icon-close class="w-4 h-4"></x-icon-close>
            </button>
        </div>
        <div class="flex-1 overflow-auto x-modal-content">
            <livewire:dashboard.employee.employee-create @employeeCreated="$refresh" />
        </div>
    </x-modal>

    <x-modal name="edit-employee-modal" closable="false" maxWidth="lg">
        <div class="flex justify-between items-start mb-4 space-x-4">
            <h4 class="font-semibold text-gray-600 pt-1 uppercase">
                Edit employee
            </h4>
            <button
                wire:click="$dispatch('close-modal', { name: 'edit-employee-modal' })"
                type="button"
                class="text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 p-2 rounded-full inline-flex items-center"
            >
                <x-icon-close class="w-4 h-4"></x-icon-close>
            </button>
        </div>
        <div class="flex-1 overflow-auto x-modal-content">
            <livewire:dashboard.employee.employee-edit @employeeEdited="$refresh" />
        </div>
    </x-modal>

    <x-modal name="edit-vendor-employee-modal" closable="false" maxWidth="lg">
        <div class="flex justify-between items-start mb-4 space-x-4">
            <h4 class="font-semibold text-gray-600 pt-1 uppercase">
                Edit Vendor
            </h4>
            <button
                wire:click="$dispatch('close-modal', { name: 'edit-vendor-employee-modal' })"
                type="button"
                class="text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 p-2 rounded-full inline-flex items-center"
            >
                <x-icon-close class="w-4 h-4"></x-icon-close>
            </button>
        </div>
        <div class="flex-1 overflow-auto x-modal-content">
            <livewire:dashboard.employee.employee-edit-vendor @employeeVendorEdited="$refresh" />
        </div>
    </x-modal>
</div>
