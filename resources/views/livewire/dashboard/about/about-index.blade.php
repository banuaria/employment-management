<div class="py-12">
    <div class="sm:px-6 lg:px-8">
        <div class="flex flex-col xl:flex-row items-start space-x-0 xl:space-x-4 space-y-4 xl:space-y-0">
            <div class="w-full xl:w-4/6 flex flex-col gap-y-4">
                <div class="p-4 sm:p-8 bg-white shadow rounded-lg w-full">
                    <div class="flex justify-between items-center">
                        <h2 class="font-semibold text-base text-gray-900">Content</h2>
                        <button wire:click="$dispatchTo('dashboard.about.about-edit', 'edited')" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500"><x-icon-edit class="w-3.5 h-3.5"></x-icon-edit></button>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center space-x-1.5">
                            <div class="text-sm font-normal text-gray-600">Updated By</div>
                            <div class="text-sm font-bold text-gray-600">{{ $about->updatedBy->name }}</div>
                            <div class="text-sm font-thin text-gray-600">{{ $about->updated_at->format('d-m-Y H:i') }}</div>
                        </div>
                        <div class="block mt-2 w-full border-gray-200 rounded-md shadow-sm p-2.5 border text-gray-900 bg-gray-50 break-anywhere">
                            <div class="tinymce-content">{!! $about->content !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="edit-about-modal" closable="false" maxWidth="5xl">
        <div class="flex justify-between items-start mb-4 space-x-4">
            <h4 class="font-semibold text-gray-600 pt-1 uppercase">
                Edit About
            </h4>
            <button
                wire:click="$dispatch('close-modal', { name: 'edit-about-modal' })"
                type="button"
                class="text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 p-2 rounded-full inline-flex items-center"
            >
                <x-icon-close class="w-4 h-4"></x-icon-close>
            </button>
        </div>
        <div class="flex-1 overflow-auto x-modal-content">
            <livewire:dashboard.about.about-edit @aboutEdited="$refresh" />
        </div>
    </x-modal>
</div>
