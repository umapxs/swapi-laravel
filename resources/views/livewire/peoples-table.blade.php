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
            <input wire:model="search" wire:model.debounce.300ms="search" type="search" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Search characters...">
        </div>
        <div class="mb-4">
            <select wire:model="orderBy" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="id">ID</option>
                <option value="name">Name</option>
                <option value="hair_color">Hair Color</option>
                <option value="skin_color">Skin Color</option>
                <option value="eye_color">Eye Color</option>
                <option value="gender">Gender</option>
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
        <!-- Change href -->
        <a href="{{ route('starships.export_view') }}" class="appearance-none bg-red-500 text-white rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 lg:mr-16 float-right hover:no-underline hover:scale-105 transition ease-in-out delay-100 mb-4">Export Excel</a>
    </div>

    <div class="tableWrapper">
        <table class="table-auto w-full mb-6 mt-6">
            <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Height</th>
                    <th class="px-4 py-2">Mass</th>
                    <th class="px-4 py-2">Hair Color</th>
                    <th class="px-4 py-2">Skin Color</th>
                    <th class="px-4 py-2">Eye Color</th>
                    <th class="px-4 py-2">Birth</th>
                    <th class="px-4 py-2">Gender</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peoples as $people)
                    <tr>
                        <td class="border px-4 py-2">{{ $people->id }}</td>
                        <td class="border px-4 py-2">{{ $people->name }}</td>
                        <td class="border px-4 py-2">{{ $people->height }}</td>
                        <td class="border px-4 py-2">{{ $people->mass }}</td>
                        <td class="border px-4 py-2">{{ $people->hair_color }}</td>
                        <td class="border px-4 py-2">{{ $people->skin_color }}</td>
                        <td class="border px-4 py-2">{{ $people->eye_color }}</td>
                        <td class="border px-4 py-2">{{ $people->birth_year }}</td>
                        <td class="border px-4 py-2">{{ $people->gender }}</td>
                        {{-- <td class="border px-4 py-2">{{ str_replace('"', '', $people->pilots); }}</td>
                        <td class="border px-4 py-2">{{ str_replace('"', '', $people->films); }}</td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {!! $peoples->links() !!}
    </div>
</div>