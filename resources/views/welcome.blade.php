<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="{{ config('app.favicon', '/images/star-wars2.png') }}">
        <script src="https://cdn.tailwindcss.com"></script>

        <title>{{ config('app.name', 'swapiProject') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    </head>
    <body>
        <div class="min-h-full">
            <nav class="bg-white-800">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-center">
                    <div class="flex items-center">
                    <div>
                        <div class="flex items-baseline space-x-4">

                            <a href="/" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Welcome</a>

                            <a href="/login" class="text-black rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-100 transition ease-in-out delay-150">Log In</a>

                            <a href="/register" class="text-black rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-100 transition ease-in-out delay-150">Register</a>
                        </div>
                    </div>
                    </div>
                    <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                    </div>
                    <div class="-mr-2 flex md:hidden">
                    <!-- Mobile menu button -->
                    <button type="button" class="inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <!-- Menu open: "hidden", Menu closed: "block" -->
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <!-- Menu open: "block", Menu closed: "hidden" -->
                        <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    </div>
                </div>
                </div>
            </nav>

            <main>
                <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                    <div class="mx-4">
                        <img src="{{ asset('/images/wallpaper3.jpg') }}" alt="Star Wars" class="flex rounded">
                    </div>
                    <div class="flex justify-center">
                        <div class="mt-8">
                            <h1 class="flex justify-center text-3xl font-bold text-black">Star Wars API</h1>
                            <div class="mx-8">
                                <p class="mt-4">
                                    Welcome to the <code class="text-red-500 px-1 py-0.5 bg-gray-200 border border-md" style="border-radius: 6px">{{config('APP_NAME', 'swapiProject')}}</code> , where the force is strong! We are excited to share with you our love for all things Star Wars related by providing you with the latest and greatest information from the Star Wars API (swapi).
                                </p>
                                <p class="mt-4 mb-4">
                                    Our web app allows you to explore and interact with the vast universe of Star Wars, from characters and spaceships from the original and prequels trilogy. You can immerse yourself in the world of Star Wars like never before, and discover new and fascinating details that you may have missed before. May the force be with you, and enjoy your journey through our site!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
