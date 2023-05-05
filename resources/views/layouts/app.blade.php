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
        <script src="/js/toastr-options.js"></script>


        <title>{{ config('app.name', 'swapiProject') }}</title>
        <!-- Fonts -->
        <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"
            rel="stylesheet"
        />
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <script
            src="https://kit.fontawesome.com/42d5adcbca.js"
            crossorigin="anonymous"
        ></script>
        <!-- Nucleo Icons -->
        <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
        <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
        <!-- Popper -->
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <!-- Main Styling -->
        <link
            href="./assets/css/argon-dashboard-tailwind.css?v=1.0.1"
            rel="stylesheet"
        />
        <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.2.0/dist/js/coreui.bundle.min.js" integrity="sha384-n0qOYeB4ohUPebL1M9qb/hfYkTp4lvnZM6U6phkRofqsMzK29IdkBJPegsyfj/r4" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="vendors/@coreui/chartjs/css/coreui-chartjs.css" rel="stylesheet">


        <style>
            body {
                background-color: #f8f9fa;
            }

            a:visited, a:link, a:active {
                color: #121212;
            }

            .sidebar-nav .nav-item .nav-link.active {
                background-color: rgba(59, 130, 246, 0.1);
            }

            .sidebar-nav .show .nav-group {
                background-color: rgba(59, 130, 246, 0.1);
            }

            a:hover {
                color: rgb(31 41 55);
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

            .nav-group[aria-expanded="true"] {
                background-color: rgba(59, 130, 246, 0.1);
            }

            .sidebar-nav .nav-group.show {
                --cui-sidebar-nav-group-bg: rgba(186, 186, 186, 0.1) !important;
            }


        </style>

        <link rel="manifest" href="manifest.json" />
        <link rel="serviceworker" href="/public/worker.js" />

        @livewireStyles
    </head>
    <body class="c-app">
        <script>
            if ('serviceWorker' in navigator) {
                //if the browser supports serviceWorkers
                window.addEventListener('load', function () {
                    navigator.serviceWorker
                    //registers the worker.js file you just made
                    .register('/public/worker.js')
                    .then(
                    function (registration) {
                        console.log(
                        'Worker registration successful',
                        registration.scope
                        );
                    },
                    function (err) {
                        console.log('Worker registration failed', err);
                    }
                    )
                    .catch(function (err) {
                    console.log(err);
                    });
                });
            } else {
                console.log('Service Worker is not supported by browser.');
            }
        </script>

        <div class="c-wrapper">
            <div class="sidebar sidebar-fixed rounded-2xl shadow-xl my-4 py-4" style="background-color: white;" id="sidebar">
                <div class="sidebar-brand d-none d-md-flex pr-4 bg-white">
                    <a href="/dashboard" class="text-black" style="text-decoration: none">
                        <img src="{{ config('app.favicon', '/images/star-wars2.png') }}" class="inline h-full max-w-full transition-all duration-200 dark:hidden ease-nav-brand max-h-8" alt="main_logo">
                        <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">Star Wars API</span>
                    </a>
                </div>
                <ul class="sidebar-nav mt-4" data-coreui="navigation" data-simplebar="">
                    <li class="nav-item">
                        <a class="nav-link text-black" href="/dashboard">
                            <svg class="nav-icon text-black">
                                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-terminal') }}"></use>
                            </svg> Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-black" href="/logs">
                            <svg class="nav-icon text-black">
                                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-devices') }}"></use>
                            </svg> Logs
                        </a>
                    </li>

                    <li class="nav-group"><a class="nav-link nav-group-toggle text-black" href="#">
                        <svg class="nav-icon text-black">
                        <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-bolt') }}"></use>
                        </svg> Fetch</a>
                    <ul class="nav-group-items">
                        <li class="nav-item"><a class="nav-link text-black" href="/fetch"><span class="nav-icon"></span> Fetch Menu</a></li>
                        <li class="nav-item"><a class="nav-link text-black" href="/starships"><span class="nav-icon"></span> Starships</a></li>
                        <li class="nav-item"><a class="nav-link text-black" href="/films"><span class="nav-icon"></span> Films</a></li>
                        <li class="nav-item"><a class="nav-link text-black" href="/peoples"><span class="nav-icon"></span> Characters</a></li>
                    </ul>

                    <li class="nav-group"><a class="nav-link nav-group-toggle text-black" href="#">
                        <svg class="nav-icon text-black">
                        <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-library') }}"></use>
                        </svg> Tables</a>
                    <ul class="nav-group-items">
                        <li class="nav-item"><a class="nav-link text-black" href="/table"><span class="nav-icon"></span>Tables Menu</a></li>
                        <li class="nav-item"><a class="nav-link text-black" href="/table/starship"><span class="nav-icon"></span> Starships</a></li>
                        <li class="nav-item"><a class="nav-link text-black" href="/table/film"><span class="nav-icon text-black"></span> Films</a></li>
                        <li class="nav-item"><a class="nav-link text-black" href="/table/people"><span class="nav-icon"></span> Characters</a></li>
                    </ul>
                </ul>
                {{-- <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button> --}}
            </div>
        </div>
        <div class="wrapper d-flex flex-column min-vh-100">
            @include('layouts.navigation')
        </div>
        <div>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="outline outline-1 outline-gray-200" style="background-color: #f8f9fa;">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8" id="locationHover">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="c-main  lg:mr-12">

                <div class="body flex-grow-1 px-3">
                    {{ $slot }}
                    <!-- Global notification (Edited Film) -->

                    @if (session()->has('edit-film-global-success'))
                        @foreach (\App\Models\User::all() as $user)
                            <div x-data="{ show: true }"
                                x-init="setTimeout(() => show = false, 4000)"
                                x-show="show"
                                class="fixed bg-red-500 rounded text-white py-2 px-2 text-sm bottom-0 right-0 mr-4 mt-8 mb-16 text-white bg-red-500 hover:bg-red-400 focus:outline-none focus:ring-red-600 dark:bg-red-500 dark:hover:bg-red-400 dark:focus:ring-red-400" style="margin-right: 1rem; display: flex; bottom: 0; margin-top: 50%;">
                                <p>{{ session()->get('edit-film-global-success') }}</p>
                            </div>
                        @endforeach
                    @endif

                    <!-- Global notification (Edited Starship) -->
                    @if (session()->has('edit-starship-global-success'))
                        @foreach (\App\Models\User::all() as $user)
                            <div x-data="{ show: true }"
                                x-init="setTimeout(() => show = false, 4000)"
                                x-show="show"
                                class="fixed bg-red-500 rounded text-white py-2 px-2 text-sm bottom-0 right-0 mr-4 mt-8 mb-16 text-white bg-red-500 hover:bg-red-400 focus:outline-none focus:ring-red-600 dark:bg-red-500 dark:hover:bg-red-400 dark:focus:ring-red-400" style="margin-right: 1rem; display: flex; bottom: 0; margin-top: 50%;">
                                <p>{{ session()->get('edit-starship-global-success') }}</p>
                            </div>
                        @endforeach
                    @endif


                    <!-- Global notification (Edited Character/People) -->
                    @if (session()->has('edit-people-global-success'))
                        @foreach (\App\Models\User::all() as $user)
                            <div x-data="{ show: true }"
                                x-init="setTimeout(() => show = false, 4000)"
                                x-show="show"
                                class="fixed bg-red-500 rounded text-white py-2 px-2 text-sm bottom-0 right-0 mr-4 mt-8 mb-16 text-white bg-red-500 hover:bg-red-400 focus:outline-none focus:ring-red-600 dark:bg-red-500 dark:hover:bg-red-400 dark:focus:ring-red-400" style="margin-right: 1rem; display: flex; bottom: 0; margin-top: 50%;">
                                <p>{{ session()->get('edit-people-global-success') }}</p>
                            </div>
                        @endforeach
                    @endif
                </div>
            </main>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.5/perfect-scrollbar.min.js" integrity="sha512-X41/A5OSxoi5uqtS6Krhqz8QyyD8E/ZbN7B4IaBSgqPLRbWVuXJXr9UwOujstj71SoVxh5vxgy7kmtd17xrJRw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            serviceWorkerRegistration.register();
        </script>
        <script type="module">
            // Import the functions you need from the SDKs you need
            import { initializeApp } from "https://www.gstatic.com/firebasejs/9.20.0/firebase-app.js";
            import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.20.0/firebase-analytics.js";
            // TODO: Add SDKs for Firebase products that you want to use
            // https://firebase.google.com/docs/web/setup#available-libraries

            // Your web app's Firebase configuration
            // For Firebase JS SDK v7.20.0 and later, measurementId is optional
            const firebaseConfig = {
                apiKey: "AIzaSyCW_4qS3sZE1Ql-nWWf-Yy2Z01EPF1symc",
                authDomain: "swapi-project-77b58.firebaseapp.com",
                projectId: "swapi-project-77b58",
                storageBucket: "swapi-project-77b58.appspot.com",
                messagingSenderId: "314101406536",
                appId: "1:314101406536:web:c90027ba9312b60a2f317d",
                measurementId: "G-248JE2JGMR"
            };

            // Initialize Firebase
            const app = initializeApp(firebaseConfig);
            const analytics = getAnalytics(app);

            // Toastr config
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        </script>
        @livewireScripts
    </body>
</html>
