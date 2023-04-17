<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-10">
            {{ __('Detailed View') }}
        </h2>
    </x-slot>
    <div class="container mx-auto">
        <div class="py-12">
            <div class="bg-white py-12 px-6 mb-4 outline outline-1 outline-offset-4 outline-gray-200 lg:mx-12">
                <div class="mb-4 ml-4">
                    <h3 class="text-3xl font-bold text-gray-900">{{ $people->name }}</h3>
                    <a href="{{ route('peoples.exportPDF', ['id' => $people->id]) }}" class="align-text-middle hover:underline md:text-red-500">Export PDF</a>
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
                <section class="flex justify-center mt-12">
                    <form method="POST" action="/peoples/{{ $people->id }}/comments" class="w-full p-6">
                        @csrf

                            <h2>Add a quick note</h2>

                            <div class="mt-6">
                                <textarea
                                    name="comment"
                                    class="p-4 w-full border-gray-200 text-sm focus:outline-none focus:ring-black"
                                    id="comment"
                                    rows="5"
                                    placeholder="What would you like to say?"></textarea>
                            </div>

                            <div class="flex justify-end mt-6 pt-6 border-t border-gray-200">
                                <button type="submit"
                                        class="bg-gray-900 text-white rounded py-3 px-4 leading-tight hover:no-underline hover:bg-gray-800 transition ease-in-out delay-100 mb-4">
                                    Post
                                </button>
                            </div>
                    </form>
                </section>
                <section class="mt-12">
                    @foreach ($comments as $comment)
                        <div class="border border-gray-100 p-6 my-6">
                            <p class="text-gray-700">{{ $comment->user->name }} · {{ $comment->created_at->diffForHumans() }}</p>
                            <div class="flex items-center mt-4">
                                <p class="text-gray-600 px-2">{{ $comment->comment }}</p>
                            </div>
                        </div>
                    @endforeach
                </section>
            </div>
        </div>
    </div>
</x-app-layout>