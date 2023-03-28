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
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="/">
                            <img class="h-8 w-8" src="{{ config('app.logo', '/images/star-wars2.png') }}" alt="Imperial Logo">
                        </a>
                    </div>
                    <div>
                        <div class="ml-10 flex items-baseline space-x-4">

                            <a href="/" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Welcome</a>

                            <a href="/login" class="text-black dark:text-red-500 rounded-md px-3 py-2 text-sm font-medium">Log In</a>

                            <a href="/register" class="text-black dark:text-red-500 rounded-md px-3 py-2 text-sm font-medium">Register</a>
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

            <header class="bg-white shadow">
                <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">Welcome</h1>
                </div>
            </header>

            <main>
                <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                    <div class="flex justify-center">
                        <div class="mt-16">
                            <h1 class="flex justify-center text-3xl font-bold text-black">This is the {{ config('app.name', 'swapiProject') }} <br> -> sign in to learn more.</h1>
                            <a href="/register" class="px-3 py-1 text-xs font-semibold">
                                <div class="mt-4 border border-gray-200 rounded p-6">
                                    <div>
                                        <div>
                                            <div>
                                                <h2 class="mt-2 text-xl font-semibold dark:text-black">Starship Fetch</h2>

                                                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                                    Click here to fetch all of the Star Wars Starships to the Database.
                                                </p>
                                                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                                    <u>
                                                        To access this feature you must be signed in.
                                                    </u>
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
