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
                        <div class="pl-8">
                            <h2 class="mt-2 text-xl text-black">
                                <span>></span>
                                Starship Fetch
                            </h2>

                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                Fetches all of the Star Wars Starships to the Database.
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" style="margin-top: 3rem;">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="/films" class="px-3 py-1 text-xs font-semibold">
                        <div class="pl-8">
                            <h2 class="mt-2 text-xl text-black">
                                <span>></span>
                                    Film Fetch
                            </h2>

                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                Fetches all of the Star Wars Films to the Database.
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" style="margin-top: 3rem;">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="/peoples" class="px-3 py-1 text-xs font-semibold">
                        <div class="pl-8">
                            <h2 class="mt-2 text-xl text-black">
                                <span>></span>
                                    Character Fetch
                            </h2>

                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                Fetches all of the Star Wars Characters to the Database.
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
