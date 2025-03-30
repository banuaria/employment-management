<div class="flex flex-col">
    <x-highlighted-articles
        label="HIGHLIGHTS"
        title="ARTICLE" 
        :type=2
        :data="$highlight_posts" 
    /> 

    <div class="w-full m-auto max-w-screen-xl px-5 py-12">
        <div class="mb-12 overflow-hidden uppercase">
            <ul class="flex -mb-px text-sm font-medium text-center overflow-x-auto">
                <li wire:click='setActive("")' class="relative mr-12">
                    <button class="inline-block py-4 text-2xl font-bold text-nowrap {{ $post_category_id === '' ? 'text-red-500' : 'text-gray-500 hover:text-gray-600' }}">{{ 'All Categories' }}</button>
                    <div class="{{ $post_category_id == '' ? 'border-red-500 border-b-2 w-2/3' : '' }}"></div>
                </li>
                @foreach ($post_categories as $key => $category)
                <li wire:click='setActive({{ $key }})' class="relative mr-12">
                    <button class="inline-block py-4 text-2xl font-bold text-nowrap {{ $post_category_id == $key ? 'text-red-500' : 'text-gray-500 hover:text-gray-600' }}">{{ $category }}</button>
                    <div class="{{ $post_category_id == $key ? 'border-red-500 border-b-2 w-2/3' : '' }}"></div>
                </li>
                @endforeach
            </ul>
        </div>
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
                <div class="px-4 py-3 text-center">No Post Found</div>
            @endif
        </div>
    </div>
</div>
