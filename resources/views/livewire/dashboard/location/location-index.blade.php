<div class="py-12">
    <div class="sm:px-6 lg:px-8">
        <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
            <div class="w-full">
                <div class="flex justify-between items-center space-x-4 mb-4">
                    <div>
                        <button wire:click="$dispatchTo('dashboard.location.location-create', 'created')" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">Add Location</button>
                    </div>
                    <div class="flex-1 flex flex-col sm:flex-row justify-end items-end space-x-0 sm:space-x-2 space-y-2 sm:space-y-0">
                        @if (count($location_categories) > 0)
                        <div class="relative w-full max-w-48">
                            <select wire:model.live.debounce.250ms="location_category_id" class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="" selected>Select Category</option>
                                @foreach ($location_categories as $key => $location_category)
                                    <option value="{{ $key }}">{{ $location_category }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        @if (count($countries) > 0)
                        <div class="relative w-full max-w-48">
                            <select wire:model.live.debounce.250ms="country" class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="" selected>Select Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country }}">{{ $country }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        @if (count($provinces) > 0)
                        <div class="relative w-full max-w-48">
                            <select wire:model.live.debounce.250ms="province" class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="" selected>Select Province</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province }}">{{ $province }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        @if (count($cities) > 0)
                        <div class="relative w-full max-w-48">
                            <select wire:model.live.debounce.250ms="city" class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="" selected>Select City</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city }}">{{ $city }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        <div class="relative w-full max-w-48">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <x-icon-search-outline class="w-3 h-5 text-gray-500"></x-icon-search-outline>
                            </div>
                            <input
                                wire:model.live.debounce.250ms="search"
                                type="text"
                                class="ps-8 block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Search Location"
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
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Category</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Address</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Email</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Phone</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Mobile</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Fax</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Detail</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Description</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        <a href="#" wire:click.prevent="sortBy('country')" class="flex justify-center items-center space-x-1">
                                            <div>Country</div>
                                            @if($sort_field == 'country')
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
                                        <a href="#" wire:click.prevent="sortBy('province')" class="flex justify-center items-center space-x-1">
                                            <div>Province</div>
                                            @if($sort_field == 'province')
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
                                        <a href="#" wire:click.prevent="sortBy('city')" class="flex justify-center items-center space-x-1">
                                            <div>City</div>
                                            @if($sort_field == 'city')
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
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Latitude</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Longitude</th>
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
                                @if (count($locations) > 0)
                                    @foreach ($locations as $key => $location)
                                    <tr class="bg-white border-b">
                                        <td class="px-4 py-3 border text-center w-0"><div class="py-1.5">{{ $locations->firstItem() + $key }}</div></td>
                                        <td class="px-4 py-3 border-r">{{ $location->name }}</td>
                                        <td class="px-4 py-3 border-r">{{ $location->locationCategory->title }}</td>
                                        <td class="px-4 py-3 border-r">{{ $location->address }}</td>
                                        <td class="px-4 py-3 border-r whitespace-nowrap">{{ $location->email }}</td>
                                        <td class="px-4 py-3 border-r whitespace-nowrap">{{ $location->phone }}</td>
                                        <td class="px-4 py-3 border-r whitespace-nowrap">{{ $location->mobile }}</td>
                                        <td class="px-4 py-3 border-r whitespace-nowrap">{{ $location->fax }}</td>
                                        <td class="px-4 py-3 border-r">{{ $location->detail }}</td>
                                        <td class="px-4 py-3 border-r">{!! $location->desc !!}</td>
                                        <td class="px-4 py-3 border-r">{{ $location->country }}</td>
                                        <td class="px-4 py-3 border-r">{{ $location->province }}</td>
                                        <td class="px-4 py-3 border-r">{{ $location->city }}</td>
                                        <td class="px-4 py-3 border-r">{{ $location->latitude }}</td>
                                        <td class="px-4 py-3 border-r">{{ $location->longitude }}</td>
                                        <td class="px-4 py-3 border-r w-0 whitespace-nowrap">
                                            <div class="flex flex-col justify-center items-center space-y-2">
                                                <div>{{ $location->createdBy->name }}</div>
                                                <div>{{ $location->created_at->format('d-m-Y H:i') }}</div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 border-r w-0 whitespace-nowrap">
                                            <div class="flex flex-col justify-center items-center space-y-2">
                                                <div>{{ $location->updatedBy->name }}</div>
                                                <div>{{ $location->updated_at->format('d-m-Y H:i') }}</div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 border-r w-0">
                                            <div class="flex justify-center items-center">
                                                <label class="relative cursor-pointer">
                                                    <input type="checkbox" value="" class="sr-only peer" wire:change="updateStatus({{ $location->id }}, $event.target.checked)" {{ $location->status ? 'checked' : ''}}>
                                                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="px-4 py-2 border-r w-0">
                                            <div class="flex justify-center items-center space-x-2">
                                                <button wire:click="$dispatchTo('dashboard.location.location-edit', 'edited', { id: {{ $location->id }} })" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500"><x-icon-edit class="w-3.5 h-3.5"></x-icon-edit></button>
                                                <button wire:click="$dispatch('alert-confirmation', { to: 'dashboard.location.location-index', data: { do: 'delete', 'id': {{ $location->id }} }, title: `Are you sure to delete location {{ $location->name }}?` })" type="button" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-500 active:bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500"><x-icon-trash class="w-3.5 h-3.5"></x-icon-trash></button>
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
                <div class="{{ $locations->hasPages() ? 'mt-4' : '' }}">
                    {{ $locations->links() }}
                </div>
            </div>
        </div>
    </div>

    <x-modal name="create-location-modal" closable="false" maxWidth="2xl">
        <div class="flex justify-between items-start mb-4 space-x-4">
            <h4 class="font-semibold text-gray-600 pt-1 uppercase">
                Add Location
            </h4>
            <button
                wire:click="$dispatch('close-modal', { name: 'create-location-modal' })"
                type="button"
                class="text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 p-2 rounded-full inline-flex items-center"
            >
                <x-icon-close class="w-4 h-4"></x-icon-close>
            </button>
        </div>
        <div class="flex-1 overflow-auto x-modal-content">
            <livewire:dashboard.location.location-create :location_categories="$location_categories" @locationCreated="$refresh" />
        </div>
    </x-modal>

    <x-modal name="edit-location-modal" closable="false" maxWidth="2xl">
        <div class="flex justify-between items-start mb-4 space-x-4">
            <h4 class="font-semibold text-gray-600 pt-1 uppercase">
                Edit Location
            </h4>
            <button
                wire:click="$dispatch('close-modal', { name: 'edit-location-modal' })"
                type="button"
                class="text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 p-2 rounded-full inline-flex items-center"
            >
                <x-icon-close class="w-4 h-4"></x-icon-close>
            </button>
        </div>
        <div class="flex-1 overflow-auto x-modal-content">
            <livewire:dashboard.location.location-edit :location_categories="$location_categories" @locationEdited="$refresh" />
        </div>
    </x-modal>
</div>
