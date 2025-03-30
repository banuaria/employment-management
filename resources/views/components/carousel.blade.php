@props([
    'covers'
])

@if (count($covers) > 0)
    @if (count($covers) == 1)
    <div class="relative overflow-hidden w-full max-w-full aspect-[3.35/1] max-h-[420px]">
        @foreach ($covers as $key => $cover)
            <div class="duration-700 ease-in-out" data-carousel-item>
                <a href="{{ $cover['url'] }}" target="_blank">
                    <img src="{{ asset($cover['path']) }}" class="absolute block w-full h-auto object-contain" alt="...">
                </a>
            </div>
        @endforeach
    </div>
    @else
        <div id="about-carousel" class="relative w-full max-w-full aspect-[3.35/1] max-h-[420px]" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-full overflow-hidden w-full">
                @foreach ($covers as $key => $cover)
                    <div class="hidden duration-700 ease-in-out h-full" data-carousel-item>
                        <a href="{{ $cover['url'] }}" target="_blank">
                            <img src="{{ asset($cover['path']) }}" class="absolute block w-full h-auto object-contain" alt="...">
                        </a>
                    </div>
                @endforeach
            </div>
            <!-- Slider indicators -->
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                @foreach ($covers as $key => $cover)
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide {{ $key + 1 }}" data-carousel-slide-to="{{ $key }}"></button>
                @endforeach
            </div>
            <!-- Slider controls -->
            <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4-4-4"/>
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
    @endif
@endif
