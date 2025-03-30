@props(['data', 'label', 'title', 'type', 'ctaLink' => null, 'ctaText' => null, 'ctaTargetBlank' => null])

<div class="w-full m-auto max-w-screen-xl px-5 py-12">
    <x-title-section title="{{$label}}" mainTitle="{{$title}}" />
    @if ($type == 1)
    <div class="w-full">
        <div class="relative grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-8">
            @foreach ($data as $item)
            <x-article-card 
                :thumbnail="$item->thumbnail"
                :category="$item->postCategory?->title"
                :title="$item->title"
                :content="$item->content"
                ctaLink="{{ route('post.detail', ['slug' => $item->slug]) }}"
                :ctaTargetBlank="$ctaTargetBlank"
                :publishedAt="$item->published_at"
            />
            @endforeach
        </div>
    </div>
    @elseif ($type == 2)
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-8">
        @foreach($data as $index => $item)
            @if($index == 0)
                <div class="row-span-2 col-span-2 bg-black w-full h-full">
                    <div class="col-span-2 md:col-span-2 relative group h-full">
                        <div class="w-full h-full aspect-square">
                            @if ($item->thumbnail)
                                <img src="{{ asset($item->thumbnail) }}" class="w-full h-full object-cover" alt="{{ $item->title }}" />
                            @else
                                <img src="{{ asset('images/default/thumbnail.png') }}" class="w-full h-full object-cover" alt="{{ $item->title }}" />
                            @endif
                        </div>
                        <div class="absolute inset-0 flex items-center justify-center bg-white bg-opacity-70 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="text-center p-4">
                                <h2 class="text-lg font-bold line-clamp-3">{{ $item->title }}</h2>
                                <p class="text-sm line-clamp-3">{!! $item->content !!}</p>
                                <div class="mx-0 lg:mx-auto w-full px-4 text-center sm:max-w-3xl sm:px-6 lg:px-8 lg:max-w-3xl mt-2">
                                    <a href={{ route('post.detail', ['slug' => $item->slug]) }}>
                                        <x-primary-button :outline="true" class="mt-4 text-nowrap">View Detail</x-primary-button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row-span-1 col-span-1 bg-black w-full h-full">
                    <div class="col-span-2 md:col-span-2 relative group">
                        <div class="w-full h-full aspect-square">
                            @if ($item->thumbnail)
                                <img src="{{ asset($item->thumbnail) }}" class="w-full h-full object-cover" alt="{{ $item->title }}" />
                            @else
                                <img src="{{ asset('images/default/thumbnail.png') }}" class="w-full h-full object-cover" alt="{{ $item->title }}" />
                            @endif
                        </div>
                        <div class="absolute inset-0 flex items-center justify-center bg-white bg-opacity-70 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="text-center p-4">
                                <h2 class="text-lg font-bold line-clamp-2">{{ $item->title }}</h2>
                                <span class="hidden lg:flex">
                                    <p class="text-sm line-clamp-1 xl:line-clamp-2">{!! $item->content !!}</p>
                                </span>
                                <div class="mx-0 lg:mx-auto w-full px-4 text-center sm:max-w-3xl sm:px-6 lg:px-8 lg:max-w-3xl mt-2">
                                    <a href={{ route('post.detail', ['slug' => $item->slug]) }}>
                                        <x-primary-button :outline="true" class="mt-4 text-nowrap">View Detail</x-primary-button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    @endif
    @if ($ctaLink)
    <div class="mt-10 mx-0 lg:mx-auto w-full px-4 text-center sm:max-w-3xl sm:px-6 lg:px-8 lg:max-w-3xl">
        <x-button-custom :ctaLink="$ctaLink" :ctaTargetBlank="$ctaTargetBlank">{{ $ctaText }}</x-primary-button>
    </div>
    @endif
</div>
