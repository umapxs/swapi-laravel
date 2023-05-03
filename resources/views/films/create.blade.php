<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-10">
            {{ __('Add a new Film') }}
        </h2>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    </x-slot>
    <div class="container mx-auto">
        <div class="py-12">
            <div class="bg-white p-12 mb-4 shadow-xl lg:mx-12">
                <form method="POST" action="{{ route('films.storeCreate') }}">
                    @csrf
                    <div class="lg:grid lg:grid-cols-2 lg:gap-4">
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 font-bold mb-2">Title:</label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="title" id="title" placeholder="Enter the film title" value="{{ old('title') }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="episode_id">
                                Episode #:
                            </label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="episode_id" name="episode_id" type="number" placeholder="Enter the episode number" value="{{ old('episode_id') }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="director">
                                Director:
                            </label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="director" name="director" type="text" placeholder="Enter the director" value="{{ old('director') }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="producer">
                                Producer:
                            </label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="producer" name="producer" type="text" placeholder="Enter the producer" value="{{ old('producer') }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2" for="datepicker">Release Date (YYYY-MM-DD):</label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" id="datepicker" name="release_date" placeholder="Enter the release date" value="{{ old('release_date') }}" required>
                        </div>

                        <div>

                        </div>

                        <div class="mb-16 mt-8 items-center flex">
                            <button class="bg-gray-900 text-white rounded py-3 px-4 leading-tight float-left hover:no-underline hover:bg-gray-800 transition ease-in-out delay-100 mb-4" type="submit">
                                Create
                            </button>
                            <a href="{{ route('films.index') }}" class="ml-4 bg-red-500 text-white rounded py-3 px-4 mb-4 leading-tight float-left hover:no-underline hover:bg-red-400 transition ease-in-out delay-100">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
		$(document).ready(function() {
			$("#datepicker").datepicker({
				dateFormat: "yy-mm-dd"
			});
		});
	</script>
</x-app-layout>