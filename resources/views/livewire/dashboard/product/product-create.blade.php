<div class="py-12">
    <div class="sm:px-6 lg:px-8">
        <form wire:submit="store">
            <div class="flex flex-col xl:flex-row items-start space-x-0 xl:space-x-4 space-y-4 xl:space-y-0">
                <div class="w-full xl:w-4/6 flex flex-col gap-y-4">
                    <div class="p-4 sm:p-8 bg-white shadow rounded-lg w-full">
                        <div class="relative">
                            <div class="mb-2">
                                <h2 class="font-semibold text-base text-gray-900">Product</h2>
                            </div>
                            <div class="flex-1">
                                <div class="w-full border border-primary-50 rounded-xl p-4">
                                    <div>
                                        <x-input-label for="title-product-create" :value="__('Title')" required="true"/>
                                        <x-text-input wire:model="title" id="title-product-create" class="block mt-1 w-full" type="text" name="title" required/>
                                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                    </div>
                                    <div class="mt-4">
                                        <x-input-label class="mb-2" for="content-product-create" :value="__('Description')" required="true"/>
                                        <div wire:ignore>
                                            <x-textarea-input wire:model.change="content" id="content-product-create" class="block mt-1 w-full tinymce-textarea" tinymce-textarea-id="1" type="text" name="content" rows="3" required></x-textarea-input>
                                        </div>
                                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                                    </div>
                                    <div class="mt-4">
                                        <x-input-label class="mb-2" for="usage-product-create" :value="__('How to Use')" required="true"/>
                                        <div wire:ignore>
                                            <x-textarea-input wire:model.change="usage" id="usage-product-create" class="block mt-1 w-full tinymce-textarea" tinymce-textarea-id="2" type="text" name="usage" rows="3" required></x-textarea-input>
                                        </div>
                                        <x-input-error :messages="$errors->get('usage')" class="mt-2" />
                                    </div>
                                    <div class="mt-4">
                                        <x-input-label for="meta-title-product-create" :value="__('Meta Title')" />
                                        <x-text-input wire:model="meta_title" id="meta-title-product-create" class="block mt-1 w-full" type="text" name="meta_title" />
                                        <x-input-error :messages="$errors->get('meta_title')" class="mt-2" />
                                    </div>
                                    <div class="mt-4">
                                        <x-input-label for="meta-desc-product-create" :value="__('Meta Description')" />
                                        <x-textarea-input wire:model="meta_desc" id="meta-desc-product-create" class="block mt-1 w-full" type="text" name="meta_desc" rows="3"></x-textarea-input>
                                        <x-input-error :messages="$errors->get('meta_desc')" class="mt-2" />
                                    </div>
                                    <div class="mt-4">
                                        <x-input-label for="meta-keywords-product-create" :value="__('Meta Keywords')" />
                                        <x-text-input wire:model="meta_keywords" id="meta-keywords-product-create" class="block mt-1 w-full" type="text" name="meta_keywords" />
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
                                    <x-input-label for="thumbnail-product-create" :value="__('Thumbnail')" required="true"/>
                                    <div class="my-1 px-11 py-4 relative flex justify-center border border-gray-200 rounded-md shadow-sm">
                                        @if (!$thumbnail)
                                        <x-icon-image wire:click="$dispatch('filemanager-picker', { to: 'dashboard.product.product-create', filetype: 'image', property: 'thumbnail' })" class="absolute top-1 left-2 w-7 h-7 text-gray-300 cursor-pointer"></x-icon-image>
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
                                    <x-input-error :messages="$errors->get('thumbnail')" class="mt-2"/>
                                </div>
                                <div class="mt-4">
                                    <div class="flex flex-row space-x-2 items-center">
                                        <x-input-label for="product-photo-paths-product-create" :value="__('Photos')" />
                                        <div class="text-xs">(Quota: {{ $product_photo_max - count($product_photo_paths) }})</div>
                                    </div>
                                    <div class="my-1 px-11 py-4 relative flex justify-center border border-gray-200 rounded-md shadow-sm">
                                        @if (count($product_photo_paths) < $product_photo_max)
                                        <x-icon-image wire:click="$dispatch('filemanager-picker', { to: 'dashboard.product.product-create', filetype: 'image', property: 'product_photo_paths' })" class="absolute top-1 left-2 w-7 h-7 text-gray-300 cursor-pointer"></x-icon-image>
                                        @endif
                                        @if (count($product_photo_paths) > 0)
                                            <div class="flex flex-wrap justify-center items-center space-y-3">
                                                @foreach ($product_photo_paths as $key => $path)
                                                <div class="relative w-56 h-56">
                                                    <img src="{{ asset($path) }}" class="w-full h-full object-contain" />
                                                    <div wire:click="resetFilemanagerPicker('product_photo_paths', {{ $key }})" class="absolute -top-2.5 -right-2.5 bg-white rounded-full">
                                                        <x-icon-remove class="w-6 h-6 text-red-600 cursor-pointer" />
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        @else
                                        <div class="relative w-56 h-56">
                                            <img src="{{ asset('images/default/photo.png') }}" class="w-full h-full object-contain" />
                                        </div>
                                        @endif
                                    </div>
                                    <x-input-error :messages="$errors->get('product_photo_paths')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 sm:p-8 bg-white shadow rounded-lg w-full">
                        <div class="relative">
                            <div class="mb-2">
                                <h2 class="font-semibold text-base text-gray-900">Category</h2>
                            </div>
                            <div class="px-0.5">
                                <div>
                                    <x-input-label for="product-category-id-product-create" :value="__('Category')" required="true"/>
                                    <select wire:model.change="product_category_id" id="product-category-id-product-create" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="" selected>Select Category</option>
                                        @if (count($product_categories) > 0)
                                            @foreach ($product_categories as $key => $product_category)
                                                <option value="{{ $key }}">{{ $product_category }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <x-input-error :messages="$errors->get('product_category_id')" class="mt-2" />
                                </div>
                                <div class="mt-4">
                                    <x-input-label for="product-subcategory-id-product-create" :value="__('Subcategory')" required="true"/>
                                    <select wire:model="product_subcategory_id" id="product-subcategory-id-product-create" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="" selected>Select Subcategory</option>
                                        @foreach ($product_subcategories as $key => $product_subcategory)
                                            <option value="{{ $key }}">{{ $product_subcategory }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('product_subcategory_id')" class="mt-2" />
                                </div>
                                <div class="mt-4">
                                    <x-input-label for="product-tag-ids-product-create" :value="__('Tags')" />
                                    <div class="flex flex-col space-y-2 mt-1">
                                        @if (count($product_tags) > 0)
                                            @foreach ($product_tags as $key => $tag)
                                                <div class="flex items-center">
                                                    <input wire:model="product_tag_ids" id="tags-{{ $key }}" type="checkbox" value="{{ $key }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                                    <label for="tags-{{ $key }}" class="ms-2 text-sm font-medium text-gray-900">{{ $tag }}</label>
                                                </div>
                                            @endforeach
                                        @else
                                        <label class="text-sm font-medium text-gray-900">No Data</label>
                                        @endif
                                    </div>
                                    <x-input-error :messages="$errors->get('product_tag_ids')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 sm:p-8 bg-white shadow rounded-lg w-full">
                        <div class="relative">
                            <div class="mb-2 flex justify-between items-center">
                                <h2 class="font-semibold text-base text-gray-900">Stores</h2>
                                <button wire:click="$dispatchTo('dashboard.product.product-create-store', 'created')" type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">Add Product Store</button>
                            </div>
                            <div class="px-0.5">
                                <div>
                                    <x-input-label for="product-stores-product-create" :value="__('Stores')" />  
                                    @if (count($product_stores) > 0)
                                        @foreach ($product_stores as $key => $store)
                                        <div class="mt-2 my-1 px-11 py-4 relative flex justify-center border border-gray-200 rounded-md shadow-sm bg-gray-50">
                                            <div class="w-full flex flex-wrap justify-center items-center space-y-4">
                                                <div class="flex flex-col justify-center items-center space-y-2 w-full h-auto">
                                                    <div>{{ $stores_default[$key] }}</div>
                                                    <a href={{ $store['url'] }} target="_blank" class="mt-1 text-sm text-blue-500">
                                                        {{ $store['url'] }}
                                                    </a>
                                                    <div class="flex justify-center items-center space-x-2">
                                                        <button wire:click="$dispatchTo('dashboard.product.product-create', 'product-store-deleted', { key: {{ $key }}, store_title: '{{ $stores_default[$key] }}' })" type="button" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-500 active:bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500"><x-icon-trash class="w-3.5 h-3.5"></x-icon-trash></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @else
                                        <div class="block mt-2 w-full border-gray-200 rounded-md shadow-sm p-2.5 border bg-gray-50">No Store Added</div>
                                    @endif
                                    <x-input-error :messages="$errors->get('product_stores')" class="mt-2" /> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <x-modal name="create-store-product-modal" closable="false" maxWidth="lg">
        <div class="flex justify-between items-start mb-4 space-x-4">
            <h4 class="font-semibold text-gray-600 pt-1 uppercase">
                Add Product Store
            </h4>
            <button
                wire:click="$dispatch('close-modal', { name: 'create-store-product-modal' })"
                type="button"
                class="text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 p-2 rounded-full inline-flex items-center"
            >
                <x-icon-close class="w-4 h-4"></x-icon-close>
            </button>
        </div>
        <div class="flex-1 overflow-auto x-modal-content">
            <livewire:dashboard.product.product-create-store :stores="$stores" key="{{ now() }}" />
        </div>
    </x-modal>
</div>
