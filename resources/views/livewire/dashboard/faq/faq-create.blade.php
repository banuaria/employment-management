<div>
    <form wire:submit="store" class="px-0.5">
        <div>
            <x-input-label for="faq-category-id-faq-create" :value="__('Category')" />
            <select wire:model="faq_category_id" id="faq-category-id-faq-create" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="" disabled selected>Select Category</option>
                @if (count($faq_categories) > 0)
                    @foreach ($faq_categories as $key => $faq_category)
                        <option value="{{ $key }}">{{ $faq_category }}</option>
                    @endforeach
                @endif
            </select>
            <x-input-error :messages="$errors->get('faq_category_id')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="question-faq-create" :value="__('Question')" />
            <x-text-input wire:model="question" id="question-faq-create" class="block mt-1 w-full" type="text" name="question" />
            <x-input-error :messages="$errors->get('question')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label class="mb-2" for="answer-faq-create" :value="__('Answer')" />
            <div wire:ignore>
                <x-textarea-input wire:model.change="answer" id="answer-faq-create" class="block mt-1 w-full tinymce-textarea" tinymce-textarea-id="1" type="text" name="answer" rows="3"></x-textarea-input>
            </div>
            <x-input-error :messages="$errors->get('answer')" class="mt-2" />
        </div>

        <div class="flex space-x-4 mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">
                <x-icon-loading wire:loading.delay wire:target="store" class="w-4 h-4 fill-indigo-600 text-gray-200 animate-spin"></x-icon-loading>
                {{ __('Save') }}
            </button>
        </div>
    </form>
</div>
