<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <meta property="og:description" content="The swapiProject allows you to explore and interact with the vast universe of Star Wars.">

        <title>{{ config('app.name', 'swapiProject') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <style>
            main {
                background-color: #ffffff ;
            }

            a:visited, a:link, a:active {
                color: #121212;
            }

            a:hover {
                color: #DC2626;
            }

            header, #locationHover, .c-main, footer  {
                margin-left: 250px;
            }

            #hamburguer {
                visibility: hidden;
            }

            @media screen and (max-width: 768px) {
                #hamburguer {
                    visibility: visible;
                }

                header, #locationHover, .c-main, footer  {
                    margin-left: 0px;
                }

            }

            @media (min-width: 768px) {
                .footer {
                    width: calc(100% - 250px);
                }
            }


        </style>

        @livewireStyles
    </head>
    <body class="c-app">
        <div class="c-wrapper">
            <div class="sidebar sidebar-dark sidebar-fixed" style="background-color: black;" id="sidebar">
                <div class="sidebar-brand d-none d-md-flex">
                    <a href="/dashboard" class="text-white">
                        <h1 class="flex justify-center font-bold text-blackflex justify-center text-l font-bold text-white
    ">Star Wars API</h1>
                    </a>
                </div>
            </div>
        </div>
        <div>
            <!-- Page Content -->
            <main class="c-main">

                <div class="body flex-grow-1 px-3">
                    {{ $slot }}
                    @if (session('success'))
                        <div x-data="{ show: true }"
                            x-init="setTimeout(() => show = false, 4000)"
                            x-show="show"
                            class="fixed bg-red-500 rounded text-white py-2 px-2 text-sm bottom-0 right-0 mr-4 mt-8 mb-16 text-white bg-red-500 hover:bg-red-400 focus:outline-none focus:ring-red-600 dark:bg-red-500 dark:hover:bg-red-400 dark:focus:ring-red-400" style="margin-right: 1rem; display: flex; bottom: 0; margin-top: 50%;">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                </div>



            </main>
        </div>
        @livewireScripts
    </body>
</html>
