<div>
    <div class="sm:px-6 lg:px-8">
        <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
            <div class="text-center font-bold text-xl">Features</div>
            <div class="w-full">
                <div class="flex justify-between items-center space-x-4 mb-4">
                    @if (count($features) < 1)
                    <div>
                        <button wire:click="$dispatchTo('dashboard.feature.feature-create', 'created')" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">Add Feature</button>
                    </div>
                    @endif
                </div>
                <div class="relative">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">No</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Title</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Cover</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Description</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Created By</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Updated By</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Status</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($features) > 0)
                                    @foreach ($features as $key => $feature)
                                    <tr class="bg-white border-b">
                                        <td class="px-4 py-3 border text-center w-0"><div class="py-1.5">{{ $features->firstItem() + $key }}</div></td>
                                        <td class="px-4 py-3 border-r">{{ $feature->title }}</td>
                                        <td class="px-4 py-3 border-r w-0">
                                            <div class="w-48 h-auto">
                                                <img src="{{ asset($feature->path) }}" class="w-full h-full object-cover" />
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 border-r">
                                            {!! $feature->desc !!}
                                        </td>
                                        <td class="px-4 py-3 border-r w-0 whitespace-nowrap">
                                            <div class="flex flex-col justify-center items-center space-y-2">
                                                <div>{{ $feature->createdBy->name }}</div>
                                                <div>{{ $feature->created_at->format('d-m-Y H:i') }}</div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 border-r w-0 whitespace-nowrap">
                                            <div class="flex flex-col justify-center items-center space-y-2">
                                                <div>{{ $feature->updatedBy->name }}</div>
                                                <div>{{ $feature->updated_at->format('d-m-Y H:i') }}</div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 border-r w-0">
                                            <div class="flex justify-center items-center">
                                                <label class="relative cursor-pointer">
                                                    <input type="checkbox" value="" class="sr-only peer" wire:change="updateStatus({{ $feature->id }}, $event.target.checked)" {{ $feature->status ? 'checked' : ''}}>
                                                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="px-4 py-2 border-r w-0">
                                            <div class="flex justify-center items-center space-x-2">
                                                <button wire:click="$dispatchTo('dashboard.feature.feature-edit', 'edited', { id: {{ $feature->id }} })" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500"><x-icon-edit class="w-3.5 h-3.5"></x-icon-edit></button>
                                                <button wire:click="$dispatch('alert-confirmation', { to: 'dashboard.feature.feature-index', data: { do: 'delete', 'id': {{ $feature->id }} }, title: `Are you sure to delete feature {{ $feature->title }}?` })" type="button" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-500 active:bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500"><x-icon-trash class="w-3.5 h-3.5"></x-icon-trash></button>
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
                <div class="{{ $features->hasPages() ? 'mt-4' : '' }}">
                    {{ $features->links() }}
                </div>
            </div>
        </div>
    </div>

    <x-modal name="create-feature-modal" closable="false" maxWidth="2xl">
        <div class="flex justify-between items-start mb-4 space-x-4">
            <h4 class="font-semibold text-gray-600 pt-1 uppercase">
                Add Feature
            </h4>
            <button
                wire:click="$dispatch('close-modal', { name: 'create-feature-modal' })"
                type="button"
                class="text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 p-2 rounded-full inline-flex items-center"
            >
                <x-icon-close class="w-4 h-4"></x-icon-close>
            </button>
        </div>
        <div class="flex-1 overflow-auto x-modal-content">
            <livewire:dashboard.feature.feature-create @featureCreated="$refresh" />
        </div>
    </x-modal>

    <x-modal name="edit-feature-modal" closable="false" maxWidth="2xl">
        <div class="flex justify-between items-start mb-4 space-x-4">
            <h4 class="font-semibold text-gray-600 pt-1 uppercase">
                Edit Feature
            </h4>
            <button
                wire:click="$dispatch('close-modal', { name: 'edit-feature-modal' })"
                type="button"
                class="text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 p-2 rounded-full inline-flex items-center"
            >
                <x-icon-close class="w-4 h-4"></x-icon-close>
            </button>
        </div>
        <div class="flex-1 overflow-auto x-modal-content">
            <livewire:dashboard.feature.feature-edit @featureEdited="$refresh" />
        </div>
    </x-modal>
</div>
