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
                            <div class="pl-8">
                                <h2 class="mt-2 text-xl font-semibold text-white-400">
                                    <u>
                                        Character List
                                    </u>
                                </h2>

                                <ul>
                                    @foreach($allPeopleData as $people)
                                        <li class="mt-4">
                                            >
                                            {{ $people['name'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <a href="/peoples/store" class="text-white bg-red-500 hover:bg-red-400 focus:outline-none  font-medium rounded-full text-sm px-5 p-4 py-2.5 text-center mr-2 mb-2 mt-4 dark:bg-red-500 dark:hover:bg-red-400">Fetch to Database</a>
                </div>
        </div>
    </div>
</x-app-layout>
