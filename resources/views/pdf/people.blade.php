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
                    <h3 class="text-3xl font-bold text-gray-900">{{ $people->name }}</h3>
                </div>
                <div class="mb-4 ml-4">
                    <p><strong>Height:</strong> {{ $people->height }}</p>
                    <p><strong>Mass:</strong> {{ $people->mass }}</p>
                    <p><strong>Hair Color:</strong> {{ $people->hair_color }}</p>
                    <p><strong>Skin Color:</strong> {{ $people->skin_color }}</p>
                    <p><strong>Eye Color:</strong> {{ $people->eye_color }}</p>
                    <p><strong>Birth:</strong> {{ $people->birth_year}}</p>
                    <p><strong>Gender:</strong> {{ $people->gender }}</p>
                </div>
            </div>
        </div>
    </div>
</x-pdf-layout>