<div class="py-12">
    <div class="sm:px-6 lg:px-8">
        <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
            <div class="w-full">
                <div class="flex justify-between items-center space-x-4 mb-4">
                    <a href="{{ route('cms.product.create') }}" wire:navigate>
                        <button type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500">Create Product</button>
                    </a>
                    <div class="flex-1 flex flex-col sm:flex-row justify-end items-end space-x-0 sm:space-x-2 space-y-2 sm:space-y-0">
                        <div class="relative w-full max-w-48">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <x-icon-search-outline class="w-3 h-5 text-gray-500"></x-icon-search-outline>
                            </div>
                            <input
                                wire:model.live.debounce.250ms="search"
                                type="text"
                                class="ps-8 block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Search Product"
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
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Thumbnail</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Photos</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Title</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Category</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Subcategory</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Tags</th>
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
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Published By</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Highlight</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Publish</th>
                                    <th rowspan="1" class="px-6 py-3 border text-center whitespace-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($products) > 0)
                                    @foreach ($products as $key => $product)
                                    <tr class="bg-white border-b">
                                        <td class="px-4 py-3 border text-center w-0"><div class="py-1.5">{{ $products->firstItem() + $key }}</div></td>
                                        <td class="px-4 py-3 border-r w-0">
                                            <div class="w-16 h-16">
                                            @if ($product->thumbnail)
                                                <img src="{{ asset($product->thumbnail) }}" class="w-full h-full object-cover" />
                                            @else
                                                <img src="{{ asset('images/default/thumbnail.png') }}" class="w-full h-full object-cover" />
                                            @endif
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 border-r w-0">
                                            <div class="w-16 h-16">
                                            @if (count($product->productPhotos) > 0)
                                                <img src="{{ asset($product->productPhotos[0]->path) }}" class="w-full h-full object-contain" />
                                            @else
                                                <img src="{{ asset('images/default/thumbnail.png') }}" class="w-full h-full object-contain" />
                                            @endif
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 border-r">{{ $product->title }}</td>
                                        <td class="px-4 py-3 border-r">
                                            <div class="whitespace-nowrap">{{ $product->productCategory->title ?? '' }}</div>
                                        </td>
                                        <td class="px-4 py-3 border-r">
                                            <div class="whitespace-nowrap">{{ $product->productSubcategory->title ?? '' }}</div>
                                        </td>
                                        <td class="px-4 py-3 border-r">
                                            <div class="flex flex-col justify-center items-start space-y-2">
                                                @foreach ($product->productTags as $tag)
                                                <div class="whitespace-nowrap px-1 bg-gray-100 rounded-md">{{ $tag->title }}</div>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 border-r w-0 whitespace-nowrap">
                                            <div class="flex flex-col justify-center items-center space-y-2">
                                                <div>{{ $product->createdBy->name }}</div>
                                                <div>{{ $product->created_at->format('d-m-Y H:i') }}</div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 border-r w-0 whitespace-nowrap">
                                            <div class="flex flex-col justify-center items-center space-y-2">
                                                <div>{{ $product->updatedBy->name }}</div>
                                                <div>{{ $product->updated_at->format('d-m-Y H:i') }}</div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 border-r w-0 whitespace-nowrap">
                                            <div class="flex flex-col justify-center items-center space-y-2">
                                                <div>{{ $product->publishedBy?->name }}</div>
                                                <div>{{ $product->published_at?->format('d-m-Y H:i') }}</div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 border-r w-0">
                                            <div class="flex justify-center items-center">
                                                <label class="relative cursor-pointer">
                                                    <input type="checkbox" value="" class="sr-only peer" wire:change="updateHighlight({{ $product->id }}, $event.target.checked)" {{ $product->highlight ? 'checked' : ''}}>
                                                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 border-r w-0">
                                            <div class="flex justify-center items-center">
                                                <label class="relative cursor-pointer">
                                                    <input type="checkbox" value="" class="sr-only peer" wire:change="updateStatus({{ $product->id }}, $event.target.checked)" {{ $product->status ? 'checked' : ''}}>
                                                    <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="px-4 py-2 border-r w-0">
                                            <div class="flex justify-center items-center space-x-2">
                                                <a href="{{ route('cms.product.edit', ['id' => $product->id]) }}" wire:navigate>
                                                    <button type="button" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500"><x-icon-edit class="w-3.5 h-3.5"></x-icon-edit></button>
                                                </a>
                                                <button wire:click="$dispatch('alert-confirmation', { to: 'dashboard.product.product-index', data: { do: 'delete', 'id': {{ $product->id }} }, title: `Are you sure to delete product {{ $product->title }}?` })" type="button" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-500 active:bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-1500"><x-icon-trash class="w-3.5 h-3.5"></x-icon-trash></button>
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
                <div class="{{ $products->hasPages() ? 'mt-4' : '' }}">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
