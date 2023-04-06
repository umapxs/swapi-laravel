<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-10">
            {{ __('Fetch') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 lg:mt-8">
            <div class="bg-white overflow-hidden outline outline-1 outline-offset-4 outline-gray-200 ">
                <a href="/starships" class="text-xs font-semibold hover:no-underline">
                    <div class="p-6 text-gray-900">
                        <div class="pl-8">
                            <h2 class="mt-2 text-xl text-black">
                                <span>></span>
                                Starship Fetch
                            </h2>

                            <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                                Fetches all of the Star Wars Starships to the Database.
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="bg-white overflow-hidden outline outline-1 outline-offset-4 outline-gray-200 lg:mb-8" style="margin-top: 3rem;">
                <a href="/films" class="text-xs font-semibold hover:no-underline">
                    <div class="p-6 text-gray-900">
                        <div class="pl-8">
                            <h2 class="mt-2 text-xl text-black">
                                <span>></span>
                                    Film Fetch
                            </h2>

                            <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                                Fetches all of the Star Wars Films to the Database.
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="bg-white overflow-hidden outline outline-1 outline-offset-4 outline-gray-200 lg:mb-8" style="margin-top: 3rem;">
                <a href="/peoples" class=" text-xs font-semibold hover:no-underline">
                    <div class="p-6 text-gray-900">
                        <div class="pl-8">
                            <h2 class="mt-2 text-xl text-black">
                                <span>></span>
                                    Character Fetch
                            </h2>

                            <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                                Fetches all of the Star Wars Characters to the Database.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
