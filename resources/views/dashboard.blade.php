<x-app-layout>

    <style>
        .grid {
            margin: 0 auto;
            max-width: 1200px;
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-10">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-8 p-4">

                    <div class="bg-black text-white p-6">
                        <h2 class="text-xl font-bold mb-4">Total Number of Starships</h2>
                        <p class="text-xl">{{ $totalStarships }}</p>
                    </div>

                    <div class="bg-black text-white p-6">
                        <h2 class="text-xl font-bold mb-4">Total Number of Films</h2>
                        <p class="text-xl">{{ $totalFilms }}</p>
                    </div>

                    <div class="bg-black text-white p-6">
                        <h2 class="text-xl font-bold mb-4">Total Number of Characters</h2>
                        <p class="text-xl font-light">{{ $totalPeoples }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
