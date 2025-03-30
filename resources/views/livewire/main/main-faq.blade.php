<div>
    <div class="w-full m-auto max-w-screen-xl px-5 py-12">
        <x-title-section title="FAQ" mainTitle="Do you have Question?"/>
        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-8 space-y-8 lg:space-y-0">
            <div class="w-full lg:w-1/3 bg-gray-100 p-8">
                <div class="flex flex-col space-y-4">
                @php
                    $counter = 1;
                @endphp
                @foreach ($faq_categories as $key => $category)
                    <div wire:click='setActive({{ $key }})' class="font-bold uppercase cursor-pointer {{ $faq_category_id == $key ? 'text-black' : 'text-gray-500' }}">
                        {{ $counter . '. ' . $category }}
                    </div>
                    @php
                        $counter++;
                    @endphp
                @endforeach
                </div>
            </div>
            <div class="w-full lg:w-2/3"> 
                <div class="text-xl font-bold uppercase cursor-pointer text-black mb-4">
                    {{ $faq_categories[$faq_category_id] }}
                </div>     
                <div id="accordion-collapse" data-accordion="collapse">
                    @foreach ($faqs as $key => $faq)
                        <h2 id="accordion-collapse-heading-{{ $key + 1 }}">
                            <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border {{ count($faqs) == $key + 1 ? '' : 'border-b-0' }} border-gray-200 focus:ring-4 focus:ring-gray-200 hover:bg-gray-100 gap-3" data-accordion-target="#accordion-collapse-body-{{ $key + 1 }}" aria-expanded="true" aria-controls="accordion-collapse-body-{{ $key + 1 }}">
                                <span>{{ $faq->question }}</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-collapse-body-{{ $key + 1 }}" class="hidden" aria-labelledby="accordion-collapse-heading-{{ $key + 1 }}">
                            <div class="p-5 border {{ count($faqs) == $key + 1 ? 'border-t-0' : 'border-b-0' }} border-gray-200 text-gray-500">
                                {!! $faq->answer !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
