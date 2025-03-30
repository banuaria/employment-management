<div>
    <div class="w-full m-auto max-w-screen-xl px-5 py-12">
        <div class="flex flex-col lg:flex-row space-y-8 lg:space-y-0 space-x-0 lg:space-x-8">
            <div class="lg:w-3/4">
                <x-title-section :title="$post->postCategory->title ?? 'Uncategorized'" :mainTitle="$post->title" />
                <p class="text-sm text-gray-500 mb-4">{{ $post->published_at->isoFormat('D MMMM YYYY HH:mm') }} | {{ $post->createdBy->name }}</p>
                @if ($post->cover)
                    <img src="{{ asset($post->cover) }}" class="w-full h-auto object-cover" alt="{{ $post->title }}" />
                @endif
                <div>
                    <div class="tinymce-content">{!! $post->content !!}</div>
                </div>
                @if (count($post->postTags) > 0)
                <div class="mt-4">
                    <span class="text-sm text-gray-500">Tags: </span>
                    @foreach ($post->postTags as $tag)
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-1.5">{{ $tag->title }}</span>
                    @endforeach
                </div>
                @endif
                <div class="sharethis-inline-share-buttons mt-4 float-left"></div>
            </div>
            <div class="lg:w-1/4">
                <h3 class="text-xl font-bold mb-4">Related Articles</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-8">
                    @foreach ($related_posts as $post)
                    <div class="relative group">
                        <div class="w-full h-full aspect-square">
                            @if ($post->thumbnail)
                                <img src="{{ asset($post->thumbnail) }}" class="w-full h-full object-cover" alt="{{ $post->title }}" />
                            @else
                                <img src="{{ asset('images/default/thumbnail.png') }}" class="w-full h-full object-cover" alt="{{ $post->title }}" />
                            @endif
                        </div>
                        <div class="absolute inset-0 flex items-center justify-center bg-white bg-opacity-70 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="text-center p-4">
                                <span class="text-sm font-bold">{{ $post->published_at->isoFormat('D MMMM YYYY HH:mm') }}</span>
                                <h2 class="text-lg font-bold line-clamp-2">{{ $post->title }}</h2>
                                <div class="mx-0 lg:mx-auto w-full px-4 text-center sm:max-w-3xl sm:px-6 lg:px-8 lg:max-w-3xl mt-2">
                                    <a href={{ route('post.detail', ['slug' => $post->slug]) }}>
                                        <x-primary-button :outline="true" class="mt-4 text-nowrap">View Detail</x-primary-button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
