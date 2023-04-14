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
                        <h3 class="text-3xl font-bold text-gray-900">{{ $starship->name }}</h3>
                    </div>
                </div>
                <div class="mb-4 ml-4">
                    <p><strong>Model:</strong> {{ $starship->model }}</p>
                    <p><strong>Manufacturer:</strong> {{ $starship->manufacturer }}</p>
                    <p><strong>Speed:</strong> {{ $starship->max_atmosphering_speed }}</p>
                    <p><strong>Crew:</strong> {{ $starship->crew }}</p>
                    <p><strong>Pasengers:</strong> {{ $starship->passengers }}</p>
                    <p><strong>Class:</strong> {{ $starship->starship_class }}</p>
                    {{-- <p><strong>Pilots:</strong> {{ str_replace('"', '', $starship->pilots); }}</p>
                    <p><strong>Films:</strong> {{ str_replace('"', '', $starship->films); }}</p> --}}
                </div>
            </div>
        </div>
    </div>
</x-pdf-layout>