<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-10">
            {{ __('Add a new Character') }}
        </h2>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    </x-slot>
    <div class="container mx-auto">
        <div class="py-12">
            <div class="bg-white p-12 mb-4 outline outline-1 outline-offset-4 outline-gray-200 lg:mx-12">
                <form method="POST" action="{{ route('peoples.storeCreate') }}">
                    @csrf
                    <div class="lg:grid lg:grid-cols-2 lg:gap-4">
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="name" id="name" placeholder="Enter the character's name" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="height">
                                Height (CM):
                            </label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="height" name="height" type="number" placeholder="Enter the character's height" value="{{ old('height') }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="mass">
                                Mass (KG):
                            </label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="mass" name="mass" type="number" placeholder="Enter the character's mass" value="{{ old('mass') }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="hair_color">
                                Hair Color:
                            </label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="hair_color" name="hair_color" type="text" placeholder="Enter the character's hair color" value="{{ old('hair_color') }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="skin_color">
                                Skin Color:
                            </label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="skin_color" name="skin_color" type="text" placeholder="Enter the character's skin color" value="{{ old('skin_color') }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="eye_color">
                                Eye Color:
                            </label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="eye_color" name="eye_color" type="text" placeholder="Enter the character's eye color" value="{{ old('eye_color') }}" required>
                        </div>
                        <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="birth_year">
                            Birth Year (BBY/ABY):
                        </label>
                        <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="birth_year" name="birth_year" type="text" placeholder="Enter the character's birth year" value="{{ old('birth_year') }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2" for="gender">
                            Gender:
                        </label>
                        <select class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="gender" name="gender" required>
                            <option value="" disabled selected>Select the character's gender</option>
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="N/a" {{ old('gender') == 'N/a' ? 'selected' : '' }}>N/a</option>
                        </select>
                    </div>
                    <div class="mb-16 mt-8 items-center flex">
                        <button type="submit" class="mr-4 bg-gray-900 text-white rounded py-3 px-4 leading-tight float-left hover:no-underline hover:bg-gray-800 transition ease-in-out delay-100 mb-4">Create Character</button>
                        <a href="{{ route('peoples.index') }}" class=" bg-red-500 text-white rounded py-3 px-4 mb-4 leading-tight float-left hover:no-underline hover:bg-red-400 transition ease-in-out delay-100">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>