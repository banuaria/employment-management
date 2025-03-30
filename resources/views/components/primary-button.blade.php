@props([
    'outline' => false, 
])

@php
    $baseClasses = 'inline-flex items-center px-4 py-2 border font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150';
    $outlineClasses = $outline 
        ? 'bg-transparent text-red-600 border-red-300 hover:bg-red-300 hover:text-white focus:ring-red-300' 
        : 'bg-red-600 text-white border-transparent hover:bg-red-500 focus:bg-red-500 active:bg-red-700 focus:ring-red-500';
@endphp

<button {{ $attributes->merge(['type' => 'submit', 'class' => "$baseClasses $outlineClasses"]) }}>
    {{ $slot }}
</button>
