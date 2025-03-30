@props(['variant' => 'primary', 'type' => 'submit', 'ctaLink' => '', 'ctaTargetBlank' => false ])

@php
$btnType = $type;
$baseClasses = 'inline-flex items-center px-4 py-2.5 border font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150';

$variantClasses = [
    'primary' => 'bg-transparent text-primary-600 border-primary-300 hover:bg-primary-400 hover:text-white',
    'secondary' => 'bg-secondary-800 hover:bg-secondary-600 focus:bg-secondary-500 active:bg-secondary-700 text-white',
    'tertiary' => 'bg-primary-400 text-white border-none hover:bg-primary-600',
];
@endphp

@if($ctaLink)
    <a 
        href="{{ $ctaLink }}" 
        target="{{ $ctaTargetBlank ? '_blank' : '_self' }}" 
        {{ $attributes->merge(['class' => "$baseClasses {$variantClasses[$variant]}"]) }}
    >
        {{ $slot }}
    </a>
@else
    <button 
        {{ $attributes->merge(['type' => "$btnType", 'class' => "$baseClasses {$variantClasses[$variant]}"]) }}
    >
        {{ $slot }}
    </button>
@endif
