<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Store API Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white px-3 py-1 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div>
                                <h2 class="mt-2 text-xl font-semibold dark:text-black">
                                    <u>
                                        Film List
                                    </u>
                                </h2>

                                <ul class="list-none hover:list-disc">
                                    @foreach($filmData['results'] as $film)
                                        <li class="mt-4">
                                            >
                                            {{ $film['title'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <a href="/films/store" class="text-white bg-red-500 hover:bg-red-400 focus:outline-none focus:ring-4 focus:ring-red-600 font-medium rounded-full text-sm px-5 p-4 py-2.5 text-center mr-2 mb-2 mt-4 dark:bg-red-500 dark:hover:bg-red-400 dark:focus:ring-red-400">Fetch to Database</a>
                </div>
        </div>
    </div>
</x-app-layout>
