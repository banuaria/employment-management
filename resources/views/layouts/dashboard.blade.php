<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="shortcut icon" href="{{ $configData->favicon ? asset($configData->favicon) : asset('images/default/favicon.png') }}" type="image/png" sizes="16x16">

        <!-- Scripts -->
        @vite(['resources/css/dashboard.css', 'resources/js/dashboard.js'])

        @livewireStyles

        @stack('custom-styles')
    </head>

    <body class="font-sans antialiased m-0 p-0">
        <nav class="ml-0 lg:ml-64 fixed left-0 top-0 right-0 px-4 py-3 bg-white border-b z-10">
            <div class="flex flex-wrap justify-between items-center">
                <div class="flex justify-start items-center">
                    <button
                        data-drawer-target="drawer-dashboard"
                        data-drawer-show="drawer-dashboard"
                        data-drawer-backdrop="true"
                        aria-controls="drawer-dashboard"
                        type="button"
                        class="text-gray-900 hover:bg-gray-100 p-2 rounded-full inline-flex items-center mr-3 lg:hidden"
                    >
                        <x-icon-menu class="w-6 h-6 text-gray-900"></x-icon-menu>
                    </button>
                    <x-title-header>{{ $header }}</x-title-header>
                </div>

                <div class="flex items-center ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('cms.profile')" wire:navigate>
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <livewire:dashboard.profile.profile-logout />
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </nav>

        <x-sidebar></x-sidebar>

        <!-- Page Content -->
        <main class="lg:ml-64 mt-14 h-[calc(100vh-56px)] bg-gray-50 min-w-80">
            <div class="flex flex-col h-full overflow-auto p-4">
                <div class="flex-1">
                    {{ $slot }}
                </div>
                <footer>
                    <div class="max-w-screen-xl mx-auto text-gray-500 text-sm text-center pt-4">
                        <span class="text-sm text-gray-500 sm:text-center">© {{ date('Y') }} <a href="/" class="hover:underline">{{ $configData->company_name }}</a>. All Rights Reserved.</span>
                    </div>
                </footer>
            </div>
        </main>

        @livewireScripts

        @stack('custom-scripts')
    </body>
</html>
