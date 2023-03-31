<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Store API Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white px-3 py-1 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 mt-12 mb-12">
                            <div class="pl-8">
                                <h2 class="mt-2 text-xl font-semibold text-white-400">
                                    <u class="text-2xl">
                                        Film List
                                    </u>
                                </h2>

                                <ul>
                                    @foreach($filmData['results'] as $film)
                                        <li class="mt-4 text-sm">
                                            >
                                            {{ $film['title'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                    </div>
                </div>
                <div class="flex justify-center mt-8">
                    <a href="/films/store" class="text-decoration-none text-white bg-gray-800 hover:bg-red-500 focus:outline-none font-medium rounded text-sm px-16 py-4 text-center mt-4">Fetch to Database</a>
                </div>
        </div>
    </div>
</x-app-layout>
