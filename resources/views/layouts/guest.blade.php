<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/x-icon" href="{{ config('app.favicon', '/images/star-wars2.png') }}">
        <script src="https://cdn.tailwindcss.com"></script>

        <title>{{ config('app.name', 'swapiProject') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <link rel="manifest" href="manifest.json" />
        <link rel="serviceworker" href="/public/worker.js" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
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
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white sm:rounded-lg outline outline-1 outline-offset-4 outline-gray-200 mx-4">
                <div class="px-3 py-1">
                    {{ $slot }}
                </div>
            </div>
        </div>
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
        </script>
    </body>
</html>
