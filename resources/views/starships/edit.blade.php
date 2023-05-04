<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-10">
            {{ __('Edit Starship') }}
        </h2>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    </x-slot>
    <div class="container mx-auto">
        <div class="py-12">
            <div class="bg-white p-12 mb-4 shadow-xl lg:mx-12">
                <form method="POST" action="{{ route('starships.update', $starship->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="lg:grid lg:grid-cols-2 lg:gap-4">
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="name" id="name" placeholder="Enter the starship's name" value="{{ $starship->name }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="model">
                                Model:
                            </label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="model" name="model" type="text" placeholder="Enter the starship's model" value="{{ $starship->model }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="manufacturer">
                                Manufacturer:
                            </label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="manufacturer" name="manufacturer" type="text" placeholder="Enter the starship's manufacturer" value="{{ $starship->manufacturer }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="max_atmosphering_speed">
                                Max Speed:
                            </label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="max_atmosphering_speed" name="max_atmosphering_speed" type="number" placeholder="Enter the starship's max atmosphering speed" value="{{ intval($starship->max_atmosphering_speed) }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="crew">
                                Crew:
                            </label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="crew" name="crew" type="number" placeholder="Enter the starship's crew size" value="{{ intval($starship->crew) }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="passengers">
                                Passengers:
                            </label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="passengers" name="passengers" type="number" placeholder="Enter the number of passengers" value="{{ intval($starship->passengers) }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="starship_class">
                                Starship Class:
                            </label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="starship_class" name="starship_class" type="text" placeholder="Enter the starship class" value="{{ $starship->starship_class }}" required>
                        </div>
                    <div>
                    </div>
                    <div class="mb-16 mt-8 items-center flex">
                        <button type="submit" class="mr-4 bg-gray-900 text-white rounded py-3 px-4 leading-tight float-left hover:no-underline hover:bg-gray-800 transition ease-in-out delay-100 mb-4">Done</button>
                        <a href="{{ route('starships.index') }}" class=" bg-red-500 text-white rounded py-3 px-4 mb-4 leading-tight float-left hover:no-underline hover:bg-red-400 transition ease-in-out delay-100">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>