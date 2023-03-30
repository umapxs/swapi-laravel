<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="/starships" class="px-3 py-1 text-xs font-semibold">
                        <div>
                            <h2 class="mt-2 text-xl text-white-400">
                                <span>></span>
                                <u>
                                    Starship Fetch
                                </u>
                            </h2>

                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                Click here to fetch all of the Star Wars Starships to the Database.
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" style="margin-top: 3rem;">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="/films" class="px-3 py-1 text-xs font-semibold">
                        <div>
                            <h2 class="mt-2 text-xl text-white-400">
                                <span>></span>
                                <u>
                                    Film Fetch
                                </u>
                            </h2>

                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                Click here to fetch all of the Star Wars Films to the Database.
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" style="margin-top: 3rem;">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="/peoples" class="px-3 py-1 text-xs font-semibold">
                        <div>
                            <h2 class="mt-2 text-xl text-white-400">
                                <span>></span>
                                <u>
                                    Character Fetch
                                </u>
                            </h2>

                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                Click here to fetch all of the Star Wars Characters to the Database.
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <h1 class="flex justify-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-6">
            <a href="/table" class="no-underline hover:underline">
            </a>
        </h1>
    </div>
</x-app-layout>
