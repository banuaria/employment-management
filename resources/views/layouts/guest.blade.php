<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <x-meta></x-meta>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="shortcut icon" href="{{ $configData->favicon ? asset($configData->favicon) : asset('images/default/favicon.png') }}" type="image/png" sizes="16x16">

        <!-- Scripts -->
        @vite(['resources/css/dashboard.css', 'resources/js/dashboard.js'])

        @livewireStyles

        @stack('custom-styles')

        {!! $configData->head_tag !!}
    </head>
    <body class="font-sans text-gray-900 antialiased m-0 p-0">
        {!! $configData->body_tag !!}

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/" wire:navigate>
                    <x-application-logo logo="{{ $configData->primary_logo ? asset($configData->primary_logo) : '' }}" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 p-6 bg-white shadow-md overflow-hidden rounded-lg">
                {{ $slot }}
            </div>
        </div>

        @livewireScripts

        @stack('custom-scripts')
    </body>
</html>
