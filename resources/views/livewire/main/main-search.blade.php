<div>
    <div class="bg-red-800 py-6">
        <h1 class="text-white text-center text-2xl font-bold">Search result for keyword "{{$keywords}}"</h1>
    </div>
    <div class="w-full m-auto max-w-screen-xl px-5 py-12">
        <div class="container mx-auto py-12">
            <h2 class="text-3xl font-semibold mb-4">Article</h2>
            <div class="w-full">
                @if (count($posts) > 0)
                    <div class="relative grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-8">
                        @foreach ($posts as $post)
                            <x-article-card 
                                :thumbnail="$post->thumbnail"
                                :category="$post->postCategory?->title"
                                :title="$post->title"
                                :content="$post->content"
                                ctaLink="{{ route('post.detail', ['slug' => $post->slug]) }}"
                                :ctaTargetBlank="false"
                                :publishedAt="$post->published_at"
                            />
                        @endforeach
                    </div>
                    @if ($posts->hasPages())
                    <div class="mt-10 mx-0 w-full px-4 text-center">
                        <button wire:click="loadMore()" type="button" class="inline-flex items-center px-4 py-2.5 border font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 bg-transparent text-primary-600 border-primary-300 hover:bg-primary-400 hover:text-white">
                            Load More
                        </button>
                    </div>  
                    @endif
                @else
                    <p class="text-gray-500 mb-8">No Post Found</p>
                @endif
            </div>
        </div>
    </div>
</div>
