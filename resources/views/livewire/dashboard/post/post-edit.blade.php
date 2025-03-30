<div class="py-12">
    <div class="sm:px-6 lg:px-8">
        <form wire:submit="store">
            <div class="flex flex-col xl:flex-row items-start space-x-0 xl:space-x-4 space-y-4 xl:space-y-0">
                <div class="w-full xl:w-4/6 flex flex-col gap-y-4">
                    <div class="p-4 sm:p-8 bg-white shadow rounded-lg w-full">
                        <div class="relative">
                            <div class="mb-2">
                                <h2 class="font-semibold text-base text-gray-900">Post</h2>
                            </div>
                            <div class="flex-1">
                                <div class="w-full border border-primary-50 rounded-xl p-4">
                                    <div>
                                        <x-input-label for="title-post-edit" :value="__('Title')" required="true"/>
                                        <x-text-input wire:model="title" id="title-post-edit" class="block mt-1 w-full" type="text" name="title" required/>
                                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                    </div>
                                    <div class="mt-4">
                                        <x-input-label class="mb-2" for="content-post-edit" :value="__('Content')" required="true"/>
                                        <div wire:ignore>
                                            <x-textarea-input wire:model.change="content" id="content-post-edit" class="block mt-1 w-full tinymce-textarea" tinymce-textarea-id="1" type="text" name="content" rows="3" required></x-textarea-input>
                                        </div>
                                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                                    </div>
                                    <div class="mt-4">
                                        <x-input-label for="meta-title-post-edit" :value="__('Meta Title')" />
                                        <x-text-input wire:model="meta_title" id="meta-title-post-edit" class="block mt-1 w-full" type="text" name="meta_title" />
                                        <x-input-error :messages="$errors->get('meta_title')" class="mt-2" />
                                    </div>
                                    <div class="mt-4">
                                        <x-input-label for="meta-desc-post-edit" :value="__('Meta Description')" />
                                        <x-textarea-input wire:model="meta_desc" id="meta-desc-post-edit" class="block mt-1 w-full" type="text" name="meta_desc" rows="3"></x-textarea-input>
                                        <x-input-error :messages="$errors->get('meta_desc')" class="mt-2" />
                                    </div>
                                    <div class="mt-4">
                                        <x-input-label for="meta-keywords-post-edit" :value="__('Meta Keywords')" />
                                        <x-text-input wire:model="meta_keywords" id="meta-keywords-post-edit" class="block mt-1 w-full" type="text" name="meta_keywords" />
                                        <x-input-error :messages="$errors->get('meta_keywords')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full xl:w-2/6 flex flex-col-reverse xl:flex-col gap-y-4">
                    <div class="p-4 sm:p-8 bg-white shadow rounded-lg w-full">
                        <div class="relative">
                            <div class="mb-4">
                                <h2 class="font-semibold text-base text-gray-900">Action</h2>
                            </div>
                            <div class="flex justify-between space-x-4">
                                <button type="submit" class="flex-1 flex justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">
                                    <x-icon-loading wire:loading.delay wire:target="store" class="w-4 h-4 fill-indigo-600 text-gray-200 animate-spin"></x-icon-loading>
                                    {{ __('Save') }}
                                </button>
                                <x-secondary-button wire:click="$dispatch('open-modal', { name: 'post-edit-preview-modal' })" class="flex-1 flex justify-center">Preview</x-secondary-button>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 sm:p-8 bg-white shadow rounded-lg w-full">
                        <div class="relative">
                            <div class="mb-2">
                                <h2 class="font-semibold text-base text-gray-900">Media</h2>
                            </div>
                            <div class="px-0.5">
                                <div>
                                    <div class="bg-yellow-50 text-xs text-yellow-700 py-3 px-3 rounded-md mb-4">
                                        <p>Perhatian :</p>
                                        <p>- Maksimum filesize di sarankan dibawah 100kb.</p>
                                        <p>Catatan :</p>
                                        <p>Mengubah filesize dan dimensi foto akan mempengaruhi performa pada website, pastikan file tetap di bawah 100kb.</p>
                                        <div class="">
                                            <a class="inline-flex bg-green-100 hover:bg-green-200 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded mt-2" href="https://tinypng.com/" target="_blank">
                                                Tools online untuk mengkompres filesize image
                                                <x-icon-link class="h-3 w-3 ms-1"/>
                                            </a>
                                        </div>
                                    </div>
                                    <x-input-label for="thumbnail-post-edit" :value="__('Thumbnail')" />
                                    <div class="my-1 px-11 py-4 relative flex justify-center border border-gray-200 rounded-md shadow-sm">
                                        @if (!$thumbnail)
                                        <x-icon-image wire:click="$dispatch('filemanager-picker', { to: 'dashboard.post.post-edit', filetype: 'image', property: 'thumbnail' })" class="absolute top-1 left-2 w-7 h-7 text-gray-300 cursor-pointer"></x-icon-image>
                                        @endif
                                        <div class="relative w-28 h-28">
                                            @if ($thumbnail)
                                            <img src="{{ asset($thumbnail) }}" class="w-full h-full object-cover" />
                                            <div wire:click="resetFilemanagerPicker('thumbnail')" class="absolute -top-2.5 -right-2.5 bg-white rounded-full">
                                                <x-icon-remove class="w-6 h-6 text-red-600 cursor-pointer" />
                                            </div>
                                            @else
                                            <img src="{{ asset('images/default/thumbnail.png') }}" class="w-full h-full object-cover" />
                                            @endif
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                                </div>
                                <div class="mt-4">
                                    <x-input-label for="cover-post-edit" :value="__('Cover')" />
                                    <div class="my-1 px-11 py-4 relative flex justify-center border border-gray-200 rounded-md shadow-sm">
                                        @if (!$cover)
                                        <x-icon-image wire:click="$dispatch('filemanager-picker', { to: 'dashboard.post.post-edit', filetype: 'image', property: 'cover' })" class="absolute top-1 left-2 w-7 h-7 text-gray-300 cursor-pointer"></x-icon-image>
                                        @endif
                                        <div class="relative w-full h-auto">
                                            @if ($cover)
                                            <img src="{{ asset($cover) }}" class="w-full h-full object-cover" />
                                            <div wire:click="resetFilemanagerPicker('cover')" class="absolute -top-2.5 -right-2.5 bg-white rounded-full">
                                                <x-icon-remove class="w-6 h-6 text-red-600 cursor-pointer" />
                                            </div>
                                            @else
                                            <img src="{{ asset('images/default/cover.png') }}" class="w-full h-full object-cover" />
                                            @endif
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('cover')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 sm:p-8 bg-white shadow rounded-lg w-full">
                        <div class="relative">
                            <div class="mb-2">
                                <h2 class="font-semibold text-base text-gray-900">Categorization</h2>
                            </div>
                            <div class="px-0.5">
                                <div>
                                    <x-input-label for="post-category-id-post-edit" :value="__('Category')" />
                                    <select wire:model.change="post_category_id" id="post-category-id-post-edit" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        <option value="" selected>Select Category</option>
                                        @if (count($post_categories) > 0)
                                            @foreach ($post_categories as $key => $post_category)
                                                <option value="{{ $key }}">{{ $post_category }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <x-input-error :messages="$errors->get('post_category_id')" class="mt-2" />
                                </div>
                                @if (count($post_subcategories) > 0)
                                <div class="mt-4">
                                    <x-input-label for="post-subcategory-id-post-edit" :value="__('Subcategory')" />
                                    <select wire:model="post_subcategory_id" id="post-subcategory-id-post-edit" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        <option value="" selected>Select Subcategory</option>
                                        @foreach ($post_subcategories as $key => $post_subcategory)
                                            <option value="{{ $key }}">{{ $post_subcategory }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('post_subcategory_id')" class="mt-2" />
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="p-4 sm:p-8 bg-white shadow rounded-lg w-full">
                        <div class="relative">
                            <div class="mb-2">
                                <h2 class="font-semibold text-base text-gray-900">Tags</h2>
                            </div>
                            <div class="px-0.5">
                                <div>
                                    <x-input-label for="post-tag-ids-post-create" :value="__('Tags')" />
                                    <div wire:ignore>
                                        <select wire:model.change="post_tag_ids" id="post-tag-ids-post-create" class="select2-select" select2-select-id="1" multiple>
                                            @if (count($post_tags) > 0)
                                                @foreach ($post_tags as $key => $tag)
                                                    <option value="{{ $key }}">{{ $tag }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('post_tag_ids')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <x-modal name="post-edit-preview-modal" closable="true" maxWidth="3xl">
        <div class="h-screen flex flex-col overflow-hidden">
            <div class="flex justify-between items-start mb-4 space-x-4">
                <h4 class="font-semibold text-gray-600 pt-1 uppercase">
                    Post Preview
                </h4>
                <button
                    wire:click="$dispatch('close-modal', { name: 'post-edit-preview-modal' })"
                    type="button"
                    class="text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 p-2 rounded-full inline-flex items-center"
                >
                    <x-icon-close class="w-4 h-4"></x-icon-close>
                </button>
            </div>
            <div class="flex-1 overflow-auto x-modal-content border border-primary-50 rounded-xl p-4">
                <div>
                    @if ($title)
                        <h1 class="text-4xl font-bold mb-4">{{ $title }}</h1>
                    @else
                        <h1 class="text-4xl font-bold mb-4">{ Here is Title }</h1>
                    @endif
                    <div class="flex items-center space-x-1.5 mb-4">
                        <div class="text-sm font-bold text-gray-600">{{ $created_by }}</div>
                        <div class="text-sm font-thin text-gray-600">{{ $published_at ? $published_at->isoFormat('D MMMM YYYY HH:mm') : '{ Here is Published At }' }}</div>
                    </div>
                    @if ($cover)
                        <div class="mb-6 flex justify-center">
                            <img src="{{ asset($cover) }}" class="w-full h-auto object-contain" />
                        </div>
                    @endif
                    @if ($content)
                        <div class="tinymce-content">{!! $content !!}</div>
                    @else
                        <div class="tinymce-content">{ Here is Content }</div>
                    @endif
                </div>
            </div>
        </div>
    </x-modal>
</div>
