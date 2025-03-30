<div class="py-12">
    <div class="sm:px-6 lg:px-8">
        <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
            <div class="w-full">
                <div class="flex justify-between items-center space-x-4 mb-4">
                    <div>
                        <button wire:click="$dispatchTo('dashboard.location-category.location-category-create', 'created')" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">Create Category</button>
                    </div>
                    <div class="flex-1 flex flex-col sm:flex-row justify-end items-end space-x-0 sm:space-x-2 space-y-2 sm:space-y-0">
                        <div class="relative w-full max-w-48">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <x-icon-search-outline class="w-3 h-5 text-gray-500"></x-icon-search-outline>
                            </div>
                            <input
                                wire:model.live.debounce.250ms="search"
                                type="text"
                                class="ps-8 block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Search Category"
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
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Title</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        <a href="#" wire:click.prevent="sortBy('created_at')" class="flex justify-center items-center space-x-1">
                                            <div>Created By</div>
                                            @if($sort_field == 'created_at')
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
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Updated By</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Status</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($location_categories) > 0)
                                    @foreach ($location_categories as $key => $location_category)
                                    <tr class="bg-white border-b">
                                        <td class="px-4 py-3 border text-center w-0"><div class="py-1.5">{{ $location_categories->firstItem() + $key }}</div></td>
                                        <td class="px-4 py-3 border-r">{{ $location_category->title }}</td>
                                        <td class="px-4 py-3 border-r w-0 whitespace-nowrap">
                                            <div class="flex flex-col justify-center items-center space-y-2">
                                                <div>{{ $location_category->createdBy->name }}</div>
                                                <div>{{ $location_category->created_at->format('d-m-Y H:i') }}</div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 border-r w-0 whitespace-nowrap">
                                            <div class="flex flex-col justify-center items-center space-y-2">
                                                <div>{{ $location_category->updatedBy->name }}</div>
                                                <div>{{ $location_category->updated_at->format('d-m-Y H:i') }}</div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 border-r w-0">
                                            <div class="flex justify-center items-center">
                                                <label class="relative cursor-pointer">
                                                    <input type="checkbox" value="" class="sr-only peer" wire:change="updateStatus({{ $location_category->id }}, $event.target.checked)" {{ $location_category->status ? 'checked' : ''}}>
                                                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="px-4 py-2 border-r w-0">
                                            <div class="flex justify-center items-center space-x-2">
                                                <button wire:click="$dispatchTo('dashboard.location-category.location-category-edit', 'edited', { id: {{ $location_category->id }} })" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500"><x-icon-edit class="w-3.5 h-3.5"></x-icon-edit></button>
                                                <button wire:click="$dispatch('alert-confirmation', { to: 'dashboard.location-category.location-category-index', data: { do: 'delete', 'id': {{ $location_category->id }} }, title: `Are you sure to delete category {{ $location_category->title }}?` })" type="button" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-500 active:bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500"><x-icon-trash class="w-3.5 h-3.5"></x-icon-trash></button>
                                            </div>
                                        </td>
                                    </tr>
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
                <div class="{{ $location_categories->hasPages() ? 'mt-4' : '' }}">
                    {{ $location_categories->links() }}
                </div>
            </div>
        </div>
    </div>

    <x-modal name="create-location-category-modal" closable="false" maxWidth="lg">
        <div class="flex justify-between items-start mb-4 space-x-4">
            <h4 class="font-semibold text-gray-600 pt-1 uppercase">
                Create Category
            </h4>
            <button
                wire:click="$dispatch('close-modal', { name: 'create-location-category-modal' })"
                type="button"
                class="text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 p-2 rounded-full inline-flex items-center"
            >
                <x-icon-close class="w-4 h-4"></x-icon-close>
            </button>
        </div>
        <div class="flex-1 overflow-auto x-modal-content">
            <livewire:dashboard.location-category.location-category-create @locationCategoryCreated="$refresh" />
        </div>
    </x-modal>

    <x-modal name="edit-location-category-modal" closable="false" maxWidth="lg">
        <div class="flex justify-between items-start mb-4 space-x-4">
            <h4 class="font-semibold text-gray-600 pt-1 uppercase">
                Edit Category
            </h4>
            <button
                wire:click="$dispatch('close-modal', { name: 'edit-location-category-modal' })"
                type="button"
                class="text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 p-2 rounded-full inline-flex items-center"
            >
                <x-icon-close class="w-4 h-4"></x-icon-close>
            </button>
        </div>
        <div class="flex-1 overflow-auto x-modal-content">
            <livewire:dashboard.location-category.location-category-edit @locationCategoryEdited="$refresh" />
        </div>
    </x-modal>
</div>
