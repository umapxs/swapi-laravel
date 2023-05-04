<x-app-layout>

    <style>
        .grid {
            margin: 0 auto;
            max-width: 1200px;
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-10">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-8 p-4">
                    <div class="hover:text-white hover:bg-black p-6 outline outline-1 outline-gray-200 transition ease-in-out duration-300 p-6 pl-8">
                        <h2 class="text-xl font-bold mb-4">Number of Starships</h2>
                        <p class="text-xl">{{ $totalStarships }}</p>
                    </div>

                    <div class="hover:text-white hover:bg-black p-6 outline outline-1 outline-gray-200 transition ease-in-out duration-300 p-6 pl-8">
                        <h2 class="text-xl font-bold mb-4">Number of Films</h2>
                        <p class="text-xl">{{ $totalFilms }}</p>
                    </div>

                    <div class="hover:text-white hover:bg-black p-6 outline outline-1 outline-gray-200 transition ease-in-out duration-300 p-6 pl-8">
                        <h2 class="text-xl font-bold mb-4">Number of Characters</h2>
                        <p class="text-xl font-light">{{ $totalPeoples }}</p>
                    </div>

                </div>

                <div class="card-body">
                    <div class="table-responsive p-2">
                        <h1 class="text-2xl font-bold mb-4 mt-4">Top 10 Oldest Characters</h1>
                        <table class="table border">
                            <tbody>
                                @foreach ($oldestPeople as $people)
                                    <tr class="align-middle">
                                        <td>
                                            <div>
                                                <a href="{{ route('peoples.show', $people['id']) }}">
                                                    {{ $people['name'] }}
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div>{{ $people['birth_year'] }}</div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div> --}}
    <!-- cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-8 p-4">
                <div class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="hover:text-white hover:bg-gray-800 p-6 transition ease-in-out duration-300 p-6 pl-8 rounded-2xl">
                        <h2 class="text-xl font-bold mb-4">Number of Starships</h2>
                        <p class="text-xl">{{ $totalStarships }}</p>
                    </div>
                </div>

                    <div class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                        <div class="hover:text-white hover:bg-gray-800 p-6 transition ease-in-out duration-300 rounded-2xl p-6 pl-8">
                            <h2 class="text-xl font-bold mb-4">Number of Films</h2>
                            <p class="text-xl">{{ $totalFilms }}</p>
                        </div>
                    </div>

                    <div class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                        <div class="hover:text-white hover:bg-gray-800 p-6 transition ease-in-out duration-300 p-6 pl-8 rounded-2xl ">
                            <h2 class="text-xl font-bold mb-4">Number of Characters</h2>
                            <p class="text-xl font-light">{{ $totalPeoples }}</p>
                        </div>
                    </div>

                </div>

                <!-- cards row 2 -->
                <div class="flex flex-wrap mt-6 -mx-3 justify-center">

                    <div
                        class="w-full max-w-full mx-4 px-3 mt-0 lg:w-8/12 lg:flex-none"
                    >
                        <div
                            class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border"
                        >
                            <div
                                class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0"
                            >
                                <h6 class="capitalize dark:text-white">
                                    Top 10 Oldest Characters
                                </h6>
                                <p
                                    class="mb-0 text-sm leading-normal dark:text-white dark:opacity-60"
                                ></p>
                            </div>
                            <div class="flex-auto p-4">
                                <div>
                                    <table class="table border">
                                        <tbody>
                                            @foreach ($oldestPeople as $people)
                                            <tr class="align-middle">
                                                <td>
                                                    <div>
                                                        <a
                                                            href="{{ route('peoples.show', $people['id']) }}"
                                                        >
                                                            {{ $people['name']
                                                            }}
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        {{ $people['birth_year']
                                                        }}
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- cards row 3 -->

                <div class="flex flex-wrap mt-6 -mx-3 justify-center">
                    <div
                        class="w-full max-w-full px-3 mx-4 mb-8 mt-0 lg:w-8/12 lg:flex-none"
                    >
                        <div
                            class="border-black/12.5 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border"
                        >
                            <div class="p-4 pb-0 rounded-t-4">
                                <h6 class="mb-0 dark:text-white">
                                    Functionalities
                                </h6>
                            </div>
                            <div class="flex-auto p-4">
                                <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                                    <li
                                        class="relative flex justify-between py-2 pr-4 mb-2 border-0 rounded-t-lg rounded-xl text-inherit"
                                    >
                                        <div class="flex items-center">
                                            <div
                                                class="inline-block w-8 h-8 mr-4 text-center text-black bg-center shadow-sm fill-current stroke-none rounded-xl
                                                shadow-xl hover:bg-gray-300
                                                bg-gray-100"
                                            >
                                            <a href="/table/starship">
                                                <svg class="icon text-black mt-1.5">
                                                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-airplane-mode') }}"></use>
                                                </svg>
                                            </a>
                                            </div>
                                            <div class="flex flex-col">
                                                <a href="/table/starship">
                                                    <h6
                                                        class="mb-1 text-sm leading-normal text-slate-700 dark:text-white
                                                        hover:text-gray-800 cursor-pointer"
                                                    >
                                                        Starships
                                                    </h6>
                                                </a>
                                                <span
                                                    class="text-xs leading-tight dark:text-white/80"
                                                    >{{ $totalStarships }} in
                                                    database
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex">
                                            <a href="/table/starship"
                                                class="group ease-in leading-pro text-xs rounded-3.5xl p-1.2 h-6.5 w-6.5 mx-0 my-auto inline-block cursor-pointer border-0 bg-transparent text-center align-middle font-bold text-slate-700 shadow-none transition-all dark:text-white"
                                            >
                                                <svg class="icon">
                                                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-arrow-right') }}"></use>
                                                </svg>
                                            </a>
                                        </div>
                                    </li>
                                    <li
                                        class="relative flex justify-between py-2 pr-4 mb-2 border-0 rounded-xl text-inherit"
                                    >
                                        <div class="flex items-center">
                                            <div
                                                class="inline-block w-8 h-8 mr-4 text-center text-black bg-center shadow-sm fill-current stroke-none rounded-xl
                                                hover:bg-gray-300 bg-gray-100"
                                            >
                                            <a href="/table/film">
                                                <svg class="icon text-black mt-1.5">
                                                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-movie') }}"></use>
                                            </a>
                                            </svg>
                                            </div>
                                            <div class="flex flex-col">
                                                <a href="/table/film">
                                                    <h6
                                                        class="mb-1 text-sm leading-normal text-slate-700 dark:text-white
                                                        hover:text-gray-800 cursor-pointer"
                                                    >
                                                        Films
                                                    </h6>
                                                </a>
                                                <span
                                                    class="text-xs leading-tight dark:text-white/80"
                                                    >{{ $totalFilms }} in
                                                    database
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex">
                                            <a href="/table/film"
                                                class="group ease-in leading-pro text-xs rounded-3.5xl p-1.2 h-6.5 w-6.5 mx-0 my-auto inline-block cursor-pointer border-0 bg-transparent text-center align-middle font-bold text-slate-700 shadow-none transition-all dark:text-white"
                                            >
                                                <svg class="icon">
                                                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-arrow-right') }}"></use>
                                                </svg>
                                            </a>
                                        </div>
                                    </li>
                                    <li
                                        class="relative flex justify-between py-2 pr-4 border-0 rounded-b-lg rounded-xl text-inherit"
                                    >
                                        <div class="flex items-center">
                                            <div
                                                class="inline-block w-8 h-8 mr-4 text-center text-black bg-center shadow-sm fill-current stroke-none rounded-xl hover:bg-gray-300 bg-gray-100"
                                            >
                                            <a href="/table/people">
                                                <svg class="icon text-black mt-1.5">
                                                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-people') }}"></use>
                                            </a>
                                            </svg>
                                            </div>
                                            <div class="flex flex-col">
                                                <a href="/table/people">
                                                    <h6
                                                        class="mb-1 text-sm leading-normal text-slate-700
                                                        hover:text-gray-800cursor-pointer"
                                                    >
                                                        Characters
                                                    </h6>
                                                </a>
                                                <span
                                                    class="text-xs leading-tight"
                                                    >{{ $totalPeoples }} in
                                                    database
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex">
                                            <a href="/table/people"
                                                class="group ease-in leading-pro text-xs rounded-3.5xl p-1.2 h-6.5 w-6.5 mx-0 my-auto inline-block cursor-pointer border-0 bg-transparent text-center align-middle font-bold text-slate-700 shadow-none transition-all dark:text-white"
                                            >
                                                <svg class="icon">
                                                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-arrow-right') }}"></use>
                                                </svg>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</x-app-layout>
