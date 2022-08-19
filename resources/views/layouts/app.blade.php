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

        <script defer type="module">
            // Import the functions you need from the SDKs you need
            import { initializeApp } from "https://www.gstatic.com/firebasejs/9.9.3/firebase-app.js";
            import { getMessaging } from "https://www.gstatic.com/firebasejs/9.9.3/firebase-messaging.js";
            // TODO: Add SDKs for Firebase products that you want to use
            // https://firebase.google.com/docs/web/setup#available-libraries

            // Your web app's Firebase configuration
            // For Firebase JS SDK v7.20.0 and later, measurementId is optional
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
            const app = initializeApp(firebaseConfig);
            const messaging = getMessaging(app);

            // Retrieve Firebase Messaging object.
            // const messaging = messaging(analytics);

            // let publicVapidKey = config('services.firebase.publicVapidKey');

            // Add the public key generated from the console here.
            // messaging.getToken("");

            function sendTokenToServer(fcm_token) {
            const user_id = {{ auth()->user()->id }};
            //console.log($user_id);
            axios.post('/api/save-token', {
                fcm_token, user_id
            })
                .then(res => {
                    console.log(res);
                })

            }

            function retreiveToken(){
                messaging.getToken(messaging, { vapidKey: "BJYNSp2OLN0SNgQmQtb_Pn0XcX02yULXIIu-1PURNrjl4TpJfFKGlfydX_T820Avc0A-lvHV0TXGo0rFOhty49Y" }).then((currentToken) => {
                    if (currentToken) {
                        sendTokenToServer(currentToken);
                        // updateUIForPushEnabled(currentToken);
                    } else {
                        // Show permission request.
                        //console.log('No Instance ID token available. Request permission to generate one.');
                        // Show permission UI.
                        //updateUIForPushPermissionRequired();
                        //etTokenSentToServer(false);
                        alert('You should allow notification!');
                    }
                }).catch((err) => {
                    console.log(err.message);
                    // showToken('Error retrieving Instance ID token. ', err);
                    // setTokenSentToServer(false);
                });
            }
            retreiveToken();
            messaging.onTokenRefresh(()=>{
                retreiveToken();


            });

            messaging.onMessage((payload)=>{
                console.log('Message received');
                console.log(payload);

                location.reload();
            });
        </script>
    </body>
</html>
