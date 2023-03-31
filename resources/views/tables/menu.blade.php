<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tables Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="/table/starship" class="px-3 py-1 text-xs font-semibold">
                        <div class="pl-8">
                            <h2 class="mt-2 text-xl text-black">
                                <span>></span>
                                Starship Table
                            </h2>

                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                Click here to view the Star Wars Starships Table.
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" style="margin-top: 3rem;">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="/table/film" class="px-3 py-1 text-xs font-semibold">
                        <div class="pl-8">
                            <h2 class="mt-2 text-xl text-black">
                                <span>></span>
                                    Film Table
                            </h2>

                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                Click here to view the Star Wars Films Table.
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" style="margin-top: 3rem;">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="/table/people" class="px-3 py-1 text-xs font-semibold">
                        <div class="pl-8">
                            <h2 class="mt-2 text-xl text-black">
                                <span>></span>
                                    Character Table
                            </h2>

                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                Click here to view the Star Wars Characters Table.
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>