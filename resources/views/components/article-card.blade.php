@props(['thumbnail', 'title', 'content', 'category', 'ctaLink', 'ctaText', 'ctaTargetBlank', 'publishedAt'])

<div class="max-w-sm overflow-hidden">
    <a href="{{ $ctaLink }}" target="{{ $ctaTargetBlank ? '_blank' : '_self' }}">
        <div class="w-full aspect-square">
        @if ($thumbnail)
            <img src="{{ asset($thumbnail) }}" class="w-full h-full object-cover" alt="{{ $title }}" />
        @else
            <img src="{{ asset('images/default/thumbnail.png') }}" class="w-full h-full object-cover" alt="{{ $title }}" />
        @endif
        </div>
        <div class="px-2 py-4">
            <label class="block uppercase tracking-wide text-red-500 text-xs font-bold mb-2">{{ $category ? $category  : 'Uncategorized'  }}</label>
            <h1 class="font-bold text-xl mb-2 line-clamp-3">{{ $title }}</h1>
            <div class="text-gray-700 text-base line-clamp-4 mb-3">
                <p>{!! $content !!}</p>
            </div>
            <span class="text-gray-500 text-sm">{{ $publishedAt->isoFormat('D MMMM YYYY HH:mm') }}</span>
        </div>
    </a>
</div>
