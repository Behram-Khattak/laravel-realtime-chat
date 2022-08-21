<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Firebase-Scripts -->
        <script src="https://www.gstatic.com/firebasejs/9.9.3/firebase-app.js"></script>
        {{-- <script src="https://www.gstatic.com/firebasejs/9.9.3/firebase-app-compat.js"></script> --}}
        {{-- <script src="https://www.gstatic.com/firebasejs/9.9.3/firebase-messaging.js"></script> --}}

        <script>
            // import { initializeApp } from "https://www.gstatic.com/firebasejs/9.9.3/firebase-app.js";
            // import { getMessaging } from "https://www.gstatic.com/firebasejs/9.9.3/firebase-messaging.js";

            const firebaseConfig = {
                apiKey: "AIzaSyDx__n9zGFB-hBqobhlIdz2HuE5CiC0PuM",
                authDomain: "cognimeet-chat.firebaseapp.com",
                projectId: "cognimeet-chat",
                storageBucket: "cognimeet-chat.appspot.com",
                messagingSenderId: "974052418909",
                appId: "1:974052418909:web:a40b61c1fff140227db4b4",
                measurementId: "G-SNSQCL6Q66"
            };

            // Initialize Firebase
            // const app = initializeApp(firebaseConfig);
            firebase.initializeApp(firebaseConfig);

            // Initialize Firebase Cloud Messaging and get a reference to the service
            // const messaging = getMessaging(app);

            // messaging.usePublicVapidKey("BJYNSp2OLN0SNgQmQtb_Pn0XcX02yULXIIu-1PURNrjl4TpJfFKGlfydX_T820Avc0A-lvHV0TXGo0rFOhty49Y");

            // sending a post request to the server with javascript axios library
            // function sendTokenToServer(fcm_token) {
            //     const user_id = "{{ auth()->user()->id }}";

            //     console.log('token recieved', fcm_token);

            //     axios.post('/api/save-token', {
            //         // fcm_token, user_id
            //         test: 'test'
            //     }).then(res => {
            //         console.log(res);
            //     });
            // }

            // Add the public key generated from the console here.
            // messaging.getToken().then((currentToken) => {
            //     if (currentToken) {
            //         // Send the token to your server and update the UI if necessary
            //         sendTokenToServer(currentToken);
            //         // ...
            //     } else {
            //         // Show permission request UI
            //         console.log('No registration token available. Request permission to generate one.');
            //         // ...
            //     }
            // }).catch((err) => {
            //     console.log('An error occurred while retrieving token. ', err);
            // // ...
            // });
        </script>

        <!-- Axios-Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        @yield('scripts')
    </body>
</html>
