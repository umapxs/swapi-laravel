<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-10">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 lg:mt-8">
            <div class="bg-white overflow-hidden sm:rounded-lg outline outline-1 outline-offset-4 outline-gray-300 ">
                <a href="/starships" class="px-3 py-1 text-xs font-semibold hover:no-underline">
                    <div class="p-6 text-gray-900">
                        <div class="pl-8">
                            <h2 class="mt-2 text-xl text-black">
                                <span>></span>
                                placeholder
                            </h2>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
