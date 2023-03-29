<div>
    <div class="w-full flex pb-10 space-x-8 justify-center">
        <div class="w-3/6 mx-1">
            <input wire:model="search" wire:model.debounce.300ms="search" type="search" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Search starships...">
        </div>
        <div>
            <select wire:model="orderBy" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="id">ID</option>
                <option value="name">Name</option>
                <option value="height">Height</option>
                <option value="mass">Mass</option>
                <option value="hair_color">Hair Color</option>
                <option value="skin_color">Skin Color</option>
                <option value="eye_color">Eye Color</option>
                <option value="birth_year">Birth</option>
                <option value="gender">Gender</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
        <div>
            <select wire:model="orderAsc" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                <option value="1">Ascending</option>
                <option value="0">Descending</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
        <div>
            <select wire:model="perPage" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                <option>5</option>
                <option>10</option>
                <option>25</option>
                <option>50</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
    </div>

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
    {!! $peoples->links() !!}
</div>