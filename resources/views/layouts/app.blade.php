<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/x-icon" href="{{ config('app.favicon', '/images/star-wars2.png') }}">
        <script src="https://cdn.tailwindcss.com"></script>

        <title>{{ config('app.name', 'swapiProject') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
                @if (session('success'))
                    <div x-data="{ show: true }"
                        x-init="setTimeout(() => show = false, 4000)"
                        x-show="show"
                        class="fixed bg-red-500 rounded text-white py-2 px-2 text-sm bottom-0 right-0 mr-4 mt-8 mb-4 text-white bg-red-500 hover:bg-red-400 focus:outline-none focus:ring-red-600 dark:bg-red-500 dark:hover:bg-red-400 dark:focus:ring-red-400" style="margin-right: 1rem; display: flex; bottom: 0; margin-top: 50%;">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
            </main>
        </div>
        @livewireScripts
    </body>
</html>
