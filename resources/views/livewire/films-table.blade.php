<div>
    <style>
        .tableWrapper {
            overflow:hidden;
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
        <a href="{{ route('films.export') }}" class="bg-red-500 text-white rounded py-3 px-4 leading-tight float-right hover:no-underline hover:bg-red-400 transition ease-in-out delay-100 mb-4 lg:mr-16">Export Excel</a>
    </div>
    <div>
        <a href="/films/store" class="bg-gray-900 text-white rounded py-3 px-4 leading-tight  float-left hover:no-underline hover:bg-gray-800 transition ease-in-out delay-100 mb-4 lg:ml-16">Fetch Data</a>
    </div>
    <div>
        <a href="#" class="bg-gray-900 text-white rounded py-3 px-4 lg:ml-8 leading-tight float-left hover:no-underline hover:bg-gray-800 transition ease-in-out delay-100">Insert</a>
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
                            <a href="{{ route('films.show', $film->id) }}" class="underline text-blue-600 hover:text-blue-900">
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
                            <a href="#" class="bg-red-500 text-white rounded py-3 px-4 leading-tight float-left hover:no-underline hover:bg-red-400 transition ease-in-out delay-100">Delete</a>
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