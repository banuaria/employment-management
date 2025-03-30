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
        @vite(['resources/css/main.css', 'resources/js/main.js'])

        @livewireStyles

        @stack('custom-styles')

        {!! $configData->head_tag !!}
    </head>
    <body class="flex flex-col min-h-screen h-full font-sans antialiased m-0 p-0">
        {!! $configData->body_tag !!}

        <livewire:main.main-header />

        <main class="flex-1 w-full m-auto">
            {{ $slot }}
        </main>

        <livewire:main.main-footer />

        @if ($configData->whatsapp_float)
            <x-whatsapp-floating class="fixed right-4 bottom-20"/>
        @endif

        @livewireScripts

        @stack('custom-scripts')
    </body>
</html>
