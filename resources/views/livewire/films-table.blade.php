<div>
    <style>
        .tableWrapper {
            overflow:hidden;
            overflow-x: scroll;
            width: 100%;
        }

    </style>
    <div class="w-full flex pb-10 space-x-8 justify-center">
        <div class="w-3/6 mx-1">
            <input wire:model="search" wire:model.debounce.300ms="search" type="search" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Search films...">
        </div>
        <div>
            <select wire:model="orderBy" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="id">ID</option>
                <option value="title">Title</option>
                <option value="episode_id">Episode</option>
                <option value="director">Director</option>
                <option value="producer">Producer</option>
                <option value="release_date">Release Date</option>
            </select>
        </div>
        <div>
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

    <div class="tableWrapper">
        <table class="table-auto w-full mb-6 mt-6">
            <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Title</th>
                    <th class="px-4 py-2">Episode</th>
                    <th class="px-4 py-2">Director/s</th>
                    <th class="px-4 py-2">Producer/s</th>
                    <th class="px-4 py-2">Release Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($films as $film)
                    <tr>
                        <td class="border px-4 py-2">{{ $film->id }}</td>
                        <td class="border px-4 py-2">{{ $film->title }}</td>
                        <td class="border px-4 py-2">{{ $film->episode_id }}</td>
                        <td class="border px-4 py-2">{{ $film->director }}</td>
                        <td class="border px-4 py-2">{{ $film->producer }}</td>
                        <td class="border px-4 py-2">{{ $film->release_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {!! $films->links() !!}
    </div>
</div>