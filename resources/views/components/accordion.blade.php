<div id="{{ $id }}" data-accordion="collapse">
    @foreach($items as $item)
        <h2 id="{{ $id }}-heading-{{ $loop->index + 1 }}">
            <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 hover:bg-gray-100" data-accordion-target="#{{ $id }}-body-{{ $loop->index + 1 }}" aria-expanded="false" aria-controls="{{ $id }}-body-{{ $loop->index + 1 }}">
                <span>{{ $item['title'] }}</span>
                <svg data-accordion-icon class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                </svg>
            </button>
        </h2>
        <div id="{{ $id }}-body-{{ $loop->index + 1 }}" class="hidden" aria-labelledby="{{ $id }}-heading-{{ $loop->index + 1 }}">
            <div class="p-5 border border-gray-200">
                {!! $item['content'] !!}
            </div>
        </div>
    @endforeach
</div>
