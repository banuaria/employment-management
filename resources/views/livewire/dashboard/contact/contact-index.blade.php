<div class="py-12">
    <div class="sm:px-6 lg:px-8">
        <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
            <div class="w-full">
                <div class="flex justify-between items-center space-x-4 mb-4">
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
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Name</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Email</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Phone</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Subject</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Message</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">
                                        <a href="#" wire:click.prevent="sortBy('created_at')" class="flex justify-center items-center space-x-1">
                                            <div>Created At</div>
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
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($contacts) > 0)
                                    @foreach ($contacts as $key => $contact)
                                    <tr class="bg-white border-b">
                                        <td class="px-4 py-3 border text-center w-0"><div class="py-1.5">{{ $contacts->firstItem() + $key }}</div></td>
                                        <td class="px-4 py-3 border-r">{{ $contact->name }}</td>
                                        <td class="px-4 py-3 border-r whitespace-nowrap">{{ $contact->email }}</td>
                                        <td class="px-4 py-3 border-r whitespace-nowrap">{{ $contact->phone }}</td>
                                        <td class="px-4 py-3 border-r">{{ $contact->subject }}</td>
                                        <td class="px-4 py-3 border-r">{{ $contact->message }}</td>
                                        <td class="px-4 py-3 border-r w-0 whitespace-nowrap">
                                            <div>{{ $contact->created_at->format('d-m-Y H:i') }}</div>
                                        </td>
                                        <td class="px-4 py-2 border-r w-0">
                                            <div class="flex justify-center items-center space-x-2">
                                                <button wire:click="$dispatch('alert-confirmation', { to: 'dashboard.contact.contact-index', data: { do: 'delete', 'id': {{ $contact->id }} }, title: `Are you sure to delete {{ $contact->name }} with email {{ $contact->email }} and phone {{ $contact->phone }}?` })" type="button" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-500 active:bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500"><x-icon-trash class="w-3.5 h-3.5"></x-icon-trash></button>
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
                <div class="{{ $contacts->hasPages() ? 'mt-4' : '' }}">
                    {{ $contacts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
