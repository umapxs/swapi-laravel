<div>
    <style>
        .tableWrapper {
            overflow-x:auto;
            overflow-x: scroll;
            width: 100%;
        }

    </style>
    <div class="w-full mb-4 justify-center block lg:flex lg:space-x-8">
        <div class="mb-4 lg:w-3/6 lg:mx-1">
            <input wire:model="search" wire:model.debounce.300ms="search" type="search" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Search films...">
        </div>
        <div class="mb-4">
            <select wire:model="orderBy" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="id">ID</option>
                <option value="title">Title</option>
                <option value="episode_id">Episode</option>
                <option value="director">Director</option>
                <option value="producer">Producer</option>
                <option value="release_date">Date</option>
            </select>
        </div>
        <div class="mb-4">
            <select wire:model="orderAsc" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                <option value="1">Ascending</option>
                <option value="0">Descending</option>
            </select>
        </div>
        <div>
            <select wire:model="perPage" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                <option>5</option>
                <option>10</option>
                <option>25</option>
                <option>50</option>
            </select>
        </div>
    </div>

    <div>
        <form action="{{ route('films.export') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-500 text-white rounded py-3 px-4 leading-tight float-right hover:no-underline hover:bg-red-400 transition ease-in-out delay-100 mb-4 lg:mr-16">
                Export Excel
            </button>
        </form>
    </div>
    <div>
        <a href="/films/store" class="bg-gray-900 text-white rounded py-3 px-4 leading-tight  float-left hover:no-underline hover:bg-gray-800 transition ease-in-out delay-100 mb-4 lg:ml-16">Fetch Data</a>
    </div>
    <div>
        <!-- Modal toggle -->
        <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="bg-gray-900 text-white rounded py-3 px-4 lg:ml-8 leading-tight float-left hover:no-underline hover:bg-gray-800 transition ease-in-out delay-100" type="button">
        Insert
        </button>

        <!-- Main modal -->
        <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="authentication-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="px-6 py-6 lg:px-8">
                        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Sign in to our platform</h3>
                        <form class="space-y-6" action="#">
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required>
                            </div>
                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                                <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            </div>
                            <div class="flex justify-between">
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required>
                                    </div>
                                    <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
                                </div>
                                <a href="#" class="text-sm text-blue-700 hover:underline dark:text-blue-500">Lost Password?</a>
                            </div>
                            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login to your account</button>
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                                Not registered? <a href="#" class="text-blue-700 hover:underline dark:text-blue-500">Create account</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tableWrapper">
        <table class="table-auto w-full mb-6 mt-6">
            <thead>
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Title</th>
                    <th class="px-4 py-2">Episode</th>
                    <th class="px-4 py-2">Director/s</th>
                    <th class="px-4 py-2">Producer/s</th>
                    <th class="px-4 py-2">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($films as $film)
                    <tr>
                        <td class="border px-4 py-2">{{ $film->id }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('films.show', $film->id) }}" class="hover:underline hover:text-red-600">
                                {{ $film->title }}
                            </a>
                        </td>
                        <td class="border px-4 py-2">{{ $film->episode_id }}</td>
                        <td class="border px-4 py-2">{{ $film->director }}</td>
                        <td class="border px-4 py-2">{{ $film->producer }}</td>
                        <td class="border px-4 py-2">{{ $film->release_date }}</td>
                        <td class="px-2">
                            <a href="#" class="bg-gray-900 text-white rounded py-3 px-8 leading-tight float-left hover:no-underline hover:bg-gray-800 transition ease-in-out delay-100">Edit</a>
                        </td>
                        <td class="px-2">
                            <a href="{{ route('films.destroy', $film->id) }}"
                                class="bg-red-500 text-white rounded py-3 px-4 leading-tight float-left hover:no-underline hover:bg-red-400 transition ease-in-out delay-100"
                                onclick="event.preventDefault(); document.getElementById('delete-form-{{ $film->id }}').submit();"
                                >
                                Delete
                            </a>
                            <form id="delete-form-{{ $film->id }}" action="{{ route('films.destroy', $film->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {!! $films->links() !!}
    </div>
</div>