@props([
    'isCenter' => true, 
    'bgImage' => null, 
    'bgVideo' => null, 
    'bgColor' => 'black',
    'label' => '',
    'title' => '', 
    'desc' => '', 
    'textColor' => 'white',
    'ctaVariant' => 'primary',
    'ctaText' => 'Learn More', 
    'ctaLink' => '#', 
    'ctaTargetBlank' => false, 
    'contentRight' => null,
    'isVideo' => false, 
    'reverse' => false,
    'backdrop' => true
])

<div  {{ $attributes->merge(['class' => "relative w-full m-auto max-w-screen-xl px-5 py-12 overflow-hidden"]) }}>
    <div class="{{ $bgColor == 'white' ? 'bg-white' : 'bg-black' }} w-full bg-cover bg-center" @if($bgImage) style="background-image: url('{{ $bgImage }}');" @endif>
        @if($backdrop)
        <div class="absolute bg-black opacity-40 inset-0 w-full h-full object-cover z-10 "></div>
        @endif
        @if($bgVideo)
            <video autoplay loop muted class="absolute inset-0 w-full h-full object-cover">
                <source src="{{ $bgVideo }}" type="video/mp4">
            </video>
        @endif
        <div class="relative z-10 mx-auto max-w-8xl block">
            <div class="flex justify-center items-center gap-10 {{ $reverse ? ($isCenter ? 'flex-col-reverse' : 'flex-col-reverse lg:flex-row-reverse') : ($isCenter ? 'flex-col' : 'flex-col lg:flex-row') }}">
                <div class="w-full lg:w1/2 sm:text-center max-w-xl mx-auto lg:text-left">
                    @if ($label)
                    <p class="{{ $isCenter ? 'text-center' : '' }} text-primary-500 text-base font-semibold tracking-wider mb-4 lg:mb-6">
                        {{ $label }}
                    </p>
                    @endif
                    <h1 class="{{ $isCenter ? 'text-center' : '' }} {{ $textColor == 'white' ? 'text-white' : 'text-black' }} block font-bold text-2xl sm:text-3xl lg:text-4xl">
                        {{ $title }}
                    </h1>
                    <p class="{{ $isCenter ? 'text-center' : '' }} {{ $textColor == 'white' ? 'text-white' : 'text-black' }} mt-4 text-md sm:text-lg lg:text-xl lg:mt-8 sm:mt-6">
                        {!! $desc !!}
                    </p>
                    <div class="{{ $isCenter ? 'text-center' : 'lg:text-left sm:text-center lg:mx-0' }} sm:mx-auto sm:max-w-lg mt-8">
                        <x-button-custom variant="primary" ctaLink="{{ $ctaLink }}" ctaTargetBlank="{{ $ctaTargetBlank }}">{{ $ctaText }}</x-primary-button>
                    </div>
                </div>
                @if($contentRight)
                <div class="w-full lg:w1/2 relative sm:max-w-xl xl:max-w-2xl sm:mx-auto lg:max-w-none lg:mx-0 lg:flex lg:items-center">
                    <div class="relative mx-auto w-full h-full">
                        @if($isVideo)
                            <div class="h-full overflow-hidden">
                                <iframe height="100%" width="100%" src="{{ $contentRight }}" allow="autoplay; fullscreen" alt="{{ $title }}"></iframe>
                            </div>
                        @else
                            <div class="h-full">
                                <img src="{{ $contentRight }}" class="relative mx-auto cover" alt="{{ $title }}">
                            </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>