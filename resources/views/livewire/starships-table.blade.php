<div>
    <head>

    </head>
        <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .tableWrapper {
            overflow:hidden;
            overflow-x: scroll;
            width: 100%;
        }

    </style>
    <div class="w-full mb-4 justify-center block lg:flex lg:space-x-8">
        <div class="mb-4 lg:w-3/6 lg:mx-1">
            <input wire:model="search" wire:model.debounce.300ms="search" type="search" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Search starships...">
        </div>
        <div class="mb-4">
            <select wire:model="orderBy" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="id">ID</option>
                <option value="name">Name</option>
                <option value="model">Model</option>
                <option value="manufacturer">Manufacturer</option>
                <option value="starship_class">Class</option>
                <option value="pilots">Pilots</option>
                <option value="films">Films</option>
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
        <a href="{{ route('starships.export') }}" class="appearance-none bg-red-500 text-white rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 lg:mr-16 float-right hover:no-underline hover:scale-105 transition ease-in-out delay-100 mb-4">Export Excel</a>
    </div>

    <div class="tableWrapper">
        <table class="table-auto w-full mb-6 mt-6">
            <thead>
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Model</th>
                    <th class="px-4 py-2">Manufacturer</th>
                    <th class="px-4 py-2">M. Speed</th>
                    <th class="px-4 py-2">Crew</th>
                    <th class="px-4 py-2">Pasengers</th>
                    <th class="px-4 py-2">Class</th>
                    <th class="px-4 py-2">Pilots</th>
                    <th class="px-4 py-2">Films</th>
                </tr>
            </thead>
            <tbody>
                @foreach($starships as $starship)
                    <tr>
                        <td class="border px-4 py-2">{{ $starship->id }}</td>
                        <td class="border px-4 py-2">{{ $starship->name }}</td>
                        <td class="border px-4 py-2">{{ $starship->model }}</td>
                        <td class="border px-4 py-2">{{ $starship->manufacturer }}</td>
                        <td class="border px-4 py-2">{{ $starship->max_atmosphering_speed }}</td>
                        <td class="border px-4 py-2">{{ $starship->crew }}</td>
                        <td class="border px-4 py-2">{{ $starship->passengers }}</td>
                        <td class="border px-4 py-2">{{ $starship->starship_class }}</td>
                        <td class="border px-4 py-2">{{ str_replace('"', '', $starship->pilots); }}</td>
                        <td class="border px-4 py-2">{{ str_replace('"', '', $starship->films); }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {!! $starships->links() !!}
    </div>
</div>