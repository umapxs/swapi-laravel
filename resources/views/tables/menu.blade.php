<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-10">
            {{ __('Tables Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg outline outline-1 outline-offset-4 outline-gray-300">
                <a href="/table/starship" class="px-3 py-1 text-xs font-semibold hover:no-underline">
                    <div class="p-6 text-gray-900">
                        <div class="pl-8">
                            <h2 class="mt-2 text-xl text-black">
                                <span>></span>
                                Starship Table
                            </h2>

                            <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                                Click here to view the Star Wars Starships Table.
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="bg-white overflow-hidden sm:rounded-lg outline outline-1 outline-offset-4 outline-gray-300" style="margin-top: 3rem;">
                <a href="/table/film" class="px-3 py-1 text-xs font-semibold hover:no-underline">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="pl-8">
                            <h2 class="mt-2 text-xl text-black">
                                <span>></span>
                                    Film Table
                            </h2>

                            <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                                Click here to view the Star Wars Films Table.
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="bg-white overflow-hidden sm:rounded-lg outline outline-1 outline-offset-4 outline-gray-300" style="margin-top: 3rem;">
                <a href="/table/people" class="px-3 py-1 text-xs font-semibold hover:no-underline">
                    <div class="p-6 text-gray-900">
                        <div class="pl-8">
                            <h2 class="mt-2 text-xl text-black">
                                <span>></span>
                                    Character Table
                            </h2>

                            <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                                Click here to view the Star Wars Characters Table.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>