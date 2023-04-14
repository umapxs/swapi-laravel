<x-pdf-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-10">
            {{ __('Detailed View') }}
        </h2>
    </x-slot>
    <div class="container mx-auto">
        <div class="py-12">
            <div class="bg-white p-12 mb-4 outline outline-1 outline-offset-4 outline-gray-200 lg:mx-12">
                <div class="mb-4">
                    <div>
                        <h1 class="font-bold text-blackflex text-l font-bold mb-4 mt-8">
                            Star Wars API
                        </h1>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900">{{ $film->title }}</h3>
                </div>
                <div class="mb-4 ml-4">
                    <p><strong>Title:</strong> {{ $film->title }}</p>
                    <p><strong>Episode:</strong> {{ $film->episode_id }}</p>
                    <p><strong>Director:</strong> {{ $film->director }}</p>
                    <p><strong>Producer:</strong> {{ $film->producer }}</p>
                    <p><strong>Release Date:</strong> {{ $film->release_date }}</p>
                </div>
            </div>
        </div>
    </div>
</x-pdf-layout>