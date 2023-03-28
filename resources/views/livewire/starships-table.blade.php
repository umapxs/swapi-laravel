<div>
    <div class="w-full flex pb-10">
        <div class="w-3/6 mx-1">
            <input wire:model="search" wire:model.debounce.300ms="search" type="search" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"placeholder="Search starships...">
        </div>
        <div class="w-1/6 relative mx-1">
            <select wire:model="orderBy" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                <option value="id">ID</option>
                <option value="name">Name</option>
                <option value="model">Model</option>
                <option value="manufacturer">Manufacturer</option>
                <option value="cost_in_credits">Cost</option>
                <option value="max_atmosphering_speed">M. Speed</option>
                <option value="crew">Crew</option>
                <option value="passengers">Pasengers</option>
                <option value="cargo_capacity">Cargo Capacity</option>
                <option value="starship_class">Class</option>
                <option value="pilots">Pilots</option>
                <option value="films">Films</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
        <div class="w-1/6 relative mx-1">
            <select wire:model="orderAsc" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                <option value="1">Ascending</option>
                <option value="0">Descending</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
        <div class="w-1/6 relative mx-1">
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

    <table class="table-auto w-full mb-6 mt-16">
        <thead>
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Model</th>
                <th class="px-4 py-2">Manufacturer</th>
                <th class="px-4 py-2">Cost</th>
                <th class="px-4 py-2">M. Speed</th>
                <th class="px-4 py-2">Crew</th>
                <th class="px-4 py-2">Pasengers</th>
                <th class="px-4 py-2">Cargo Capacity</th>
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
                    <td class="border px-4 py-2">{{ $starship->cost_in_credits }}</td>
                    <td class="border px-4 py-2">{{ $starship->max_atmosphering_speed }}</td>
                    <td class="border px-4 py-2">{{ $starship->crew }}</td>
                    <td class="border px-4 py-2">{{ $starship->passengers }}</td>
                    <td class="border px-4 py-2">{{ $starship->cargo_capacity }}</td>
                    <td class="border px-4 py-2">{{ $starship->starship_class }}</td>
                    <td class="border px-4 py-2">{{ $starship->pilots }}</td>
                    <td class="border px-4 py-2">{{ $starship->films }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $starships->links() !!}
</div>