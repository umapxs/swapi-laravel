<header>
    <link href="nav/coreui-chartjs.css" rel="stylesheet">

</header>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Starship Table') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg outline outline-1 outline-offset-4 outline-gray-300"
            style="margin-top: 3rem;">
                <div class="p-6 text-gray-900 pl-8">
                    <livewire:starships-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>