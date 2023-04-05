<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/x-icon" href="{{ config('app.favicon', '/images/star-wars2.png') }}">
        <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.2.0/dist/css/coreui.min.css" rel="stylesheet" integrity="sha384-UkVD+zxJKGsZP3s/JuRzapi4dQrDDuEf/kHphzg8P3v8wuQ6m9RLjTkPGeFcglQU" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <meta property="og:image" content="http://127.0.0.1:8000/images/star-wars2.png"/>
        <meta property="og:description" content="The swapiProject allows you to explore and interact with the vast universe of Star Wars.">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.5/css/perfect-scrollbar.min.css" integrity="sha512-ygIxOy3hmN2fzGeNqys7ymuBgwSCet0LVfqQbWY10AszPMn2rB9JY0eoG0m1pySicu+nvORrBmhHVSt7+GI9VA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <title>{{ config('app.name', 'swapiProject') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.2.0/dist/js/coreui.bundle.min.js" integrity="sha384-n0qOYeB4ohUPebL1M9qb/hfYkTp4lvnZM6U6phkRofqsMzK29IdkBJPegsyfj/r4" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="vendors/@coreui/chartjs/css/coreui-chartjs.css" rel="stylesheet">

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
            }

            @media screen and (max-width: 768px) {
                header, #locationHover, .c-main, footer  {
                    margin-left: 0px;
                }
            }

        </style>

        @livewireStyles
    </head>
    <body class="c-app">
        <div class="c-wrapper">
            <div class="sidebar sidebar-dark sidebar-fixed" style="background-color: black;" id="sidebar">
                <div class="sidebar-brand d-none d-md-flex">
                    <a href="/fetch" class="text-white">
                        <h1 class="flex justify-center font-bold text-blackflex justify-center text-l font-bold text-white
    ">Star Wars API</h1>
                    </a>
                </div>
                <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
                    <li class="nav-item">
                        <a class="nav-link" href="/fetch">
                            <svg class="nav-icon">
                                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-house') }}"></use>
                            </svg> Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard">
                            <svg class="nav-icon">
                                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-terminal') }}"></use>
                            </svg> Dashboard
                        </a>
                    </li>

                    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                        <svg class="nav-icon">
                        <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-bolt') }}"></use>
                        </svg> Fetch</a>
                    <ul class="nav-group-items">
                        <li class="nav-item"><a class="nav-link" href="/fetch"><span class="nav-icon"></span> Fetch Menu</a></li>
                        <li class="nav-item"><a class="nav-link" href="/starships"><span class="nav-icon"></span> Starships</a></li>
                        <li class="nav-item"><a class="nav-link" href="/films"><span class="nav-icon"></span> Films</a></li>
                        <li class="nav-item"><a class="nav-link" href="/peoples"><span class="nav-icon"></span> Characters</a></li>
                    </ul>

                    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                        <svg class="nav-icon">
                        <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-library') }}"></use>
                        </svg> Tables</a>
                    <ul class="nav-group-items">
                        <li class="nav-item"><a class="nav-link" href="/table"><span class="nav-icon"></span>Tables Menu</a></li>
                        <li class="nav-item"><a class="nav-link" href="/table/starship"><span class="nav-icon"></span> Starships</a></li>
                        <li class="nav-item"><a class="nav-link" href="/table/film"><span class="nav-icon"></span> Films</a></li>
                        <li class="nav-item"><a class="nav-link" href="/table/people"><span class="nav-icon"></span> Characters</a></li>
                    </ul>
                </ul>
                {{-- <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button> --}}
            </div>
        </div>
        <div class="wrapper d-flex flex-column min-vh-100 bg-light">
            @include('layouts.navigation')
        </div>
        <div>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white outline outline-1 outline-gray-200">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8" id="locationHover">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="c-main">

                <div class="body flex-grow-1 px-3">
                    {{ $slot }}
                    @if (session('success'))
                        <div x-data="{ show: true }"
                            x-init="setTimeout(() => show = false, 4000)"
                            x-show="show"
                            class="fixed bg-red-500 rounded text-white py-2 px-2 text-sm bottom-0 right-0 mr-4 mt-8 mb-4 text-white bg-red-500 hover:bg-red-400 focus:outline-none focus:ring-red-600 dark:bg-red-500 dark:hover:bg-red-400 dark:focus:ring-red-400" style="margin-right: 1rem; display: flex; bottom: 0; margin-top: 50%;">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                </div>



            </main>
        </div>
        <footer class="footer bg-white px-12">
            <div class="flex justify-center text-sm"><a href="https://coreui.io" class="text-sm">CoreUI Bootstrap Admin Template</a> © 2023 creativeLabs.</div>
            <div class="flex justify-start text-sm">Powered by&nbsp;<a href="https://coreui.io/docs/" class="lg;text-sm">CoreUI UI Components</a></div>
        </footer>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.5/perfect-scrollbar.min.js" integrity="sha512-X41/A5OSxoi5uqtS6Krhqz8QyyD8E/ZbN7B4IaBSgqPLRbWVuXJXr9UwOujstj71SoVxh5vxgy7kmtd17xrJRw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        @livewireScripts
    </body>
</html>
