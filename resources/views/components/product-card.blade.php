@props(['thumbnail', 'title', 'category', 'ctaLink', 'ctaText', 'ctaTargetBlank'])

<div class="max-w-sm overflow-hidden">
    <a href="{{ $ctaLink }}" target="{{ $ctaTargetBlank ? '_blank' : '_self' }}">
        <div class="w-full aspect-square">
            @if ($thumbnail)
                <img src="{{ asset($thumbnail) }}" class="w-full h-full object-cover" alt="{{ $title }}" />
            @else
                <img src="{{ asset('images/default/thumbnail.png') }}" class="w-full h-full object-cover" alt="{{ $title }}" />
            @endif
        </div>
    </a>
    <div class="flex-grow text-center items-center justify-center px-2 py-4 h-32">
        <label class="block uppercase tracking-wide text-red-500 text-xs font-bold mb-2 line-clamp-1">{{ $category }}</label>
        <h1 class="font-bold text-xl mb-2 line-clamp-2">{{ $title }}</h1>
    </div>
    <div class="mx-0 lg:mx-auto w-full px-4 text-center sm:max-w-3xl sm:px-6 lg:px-8 lg:max-w-3xl">
        <x-button-custom :ctaLink="$ctaLink" :ctaTargetBlank="$ctaTargetBlank">{{ $ctaText }}</x-primary-button>
    </div>
</div>