<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chats') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container mx-auto">
                    <div class="min-w-full border rounded lg:grid">
                        {{-- <div class="border-r border-gray-300 lg:col-span-1">
                            <div class="mx-3 my-3">
                            <div class="relative text-gray-600">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    viewBox="0 0 24 24" class="w-6 h-6 text-gray-300">
                                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                </span>
                                <input type="search" class="block w-full rounded-full py-2 pl-10 bg-gray-100 outline-none" name="search"
                                placeholder="Search" required />
                            </div>
                            </div>

                            <ul class="overflow-auto">
                            <h2 class="my-2 mb-2 ml-2 text-lg text-gray-600">Chats</h2>
                            <li>
                                <a
                                class="flex items-center px-3 py-2 text-sm transition duration-150 ease-in-out border-b border-gray-300 cursor-pointer hover:bg-gray-100 focus:outline-none">
                                <div class="w-full pb-2">
                                    <div class="flex justify-between">
                                        <span class="block ml-2 font-semibold text-gray-600">Jhon Don</span>
                                        <span class="block ml-2 text-sm text-gray-600">25 minutes</span>
                                    </div>
                                </div>
                                </a>
                            </li>
                            </ul>
                        </div> --}}
                        <div class="hidden lg:col-span-2 lg:block">
                            <div class="w-full">
                            <div class="relative flex items-center p-3 border-b bg-white border-gray-300">
                                <span class="block ml-2 font-bold text-gray-600">Lets Chat</span>
                            </div>
                            <div class="relative w-full p-6 overflow-y-auto">

                                <ul class="space-y-2">
                                    {{-- @foreach ($chats as $chat)
                                    @if ($chat->sender_id == auth()->user()->id)
                                        <li class="flex justify-start">
                                            <div class="relative max-w-xl px-4 py-2 bg-gray-100 text-gray-700 rounded shadow">
                                                <b class="text-gray-500">
                                                    {{ $chat->sender_name }}
                                                </b><br>
                                            <span class="block">{{ $chat->message }}</span>
                                            </div>
                                        </li>
                                        @else
                                        <li class="flex justify-end">
                                            <div class="relative max-w-xl px-4 py-2 text-gray-700 bg-gray-100 rounded shadow">
                                                <b class="text-gray-500">
                                                    {{ $chat->sender_name }}
                                                </b><br>
                                            <span class="block">{{ $chat->message }}</span>
                                            </div>
                                        </li>
                                    @endif
                                    @endforeach --}}
                                </ul>

                            </div>

                            <div class="w-full p-3 border-t bg-white border-gray-300">
                                <form class="flex items-center justify-between" action="#" method="POST">
                                    @csrf
                                    <input type="text" placeholder="Message"
                                    class="block w-full py-2 pl-4 mx-3 bg-gray-100 rounded-full outline-none focus:text-gray-700"
                                    name="message" required />
                                    <button type="submit">
                                        <svg class="w-5 h-5 text-gray-500 origin-center transform rotate-90" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                        </svg>
                                    </button>
                                </form>

                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script type="module">
            // Initialize Firebase Cloud Messaging and get a reference to the service
            const messaging = firebase.messaging();

            messaging.usePublicVapidKey("BJYNSp2OLN0SNgQmQtb_Pn0XcX02yULXIIu-1PURNrjl4TpJfFKGlfydX_T820Avc0A-lvHV0TXGo0rFOhty49Y");

            // sending a post request to the server with javascript axios library
            function sendTokenToServer(token) {
                const user_id = "{{ auth()->user()->id }}";

                axios.post('/api/save-token', {
                    token, user_id
                })
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
            }

            // Add the public key generated from the console here.
            messaging.getToken().then((currentToken) => {
                if (currentToken) {
                    // Send the token to your server and update the UI if necessary
                    sendTokenToServer(currentToken);
                    // ...
                } else {
                    // Show permission request UI
                    console.log('No registration token available. Request permission to generate one.');
                    // ...
                }
            }).catch((err) => {
                console.log('An error occurred while retrieving token. ', err);
            // ...
            });
        </script>
    @endsection
</x-app-layout>
