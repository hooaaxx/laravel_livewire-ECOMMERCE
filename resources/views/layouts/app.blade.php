<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('Klight', 'Klight Apparel & Clothing') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <style>[x-cloak] { display: none; }</style>
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div x-data="{ activeTab: 1 }" class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-gray-500">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <footer class="text-center lg:text-left bg-gray-100 text-black">
                {{ $footer }}
                <div class="relative">
                    <div class="text-center p-6 bg-black fixed inset-x-0 bottom-0">
                        <span class="text-violet-500" >© 2021 Copyright:</span>
                        <a class="text-violet-500 font-semibold" href="/">Klight Apparel & Clothing</a>
                    </div>
                </div>
            </footer>
        </div>
        
        @livewireScripts

        @yield('scripts')
        @yield('carousel')
    </body>
</html>
