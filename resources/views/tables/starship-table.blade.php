<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Starship Table') }}
        </h2>
    </x-slot>

    <div class="py-12">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <livewire:starships-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>