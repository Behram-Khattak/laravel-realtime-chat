<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chats') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="card m-5">
                    <div class="card-body">
                        <h4 class="card-title bg-gray-200 p-5">Chats</h4>
                            {{-- @foreach ($chats as $chat)
                                @if ($chat->sender_id == auth()->user()->id)
                                    <b class="card-text border rounded border-red-500">{{ $chat->sender_name }}</b>
                                    <p class="card-text border rounded border-red-500">{{ $chat->message }}</p>
                                    @else
                                    <b class="card-text border rounded border-green-500">{{ $chat->sender_name }}</b>
                                    <p class="card-text border rounded border-green-500">{{ $chat->message }}</p>
                                @endif
                            @endforeach --}}
                    </div>
                </div>

                <div class="m-10">
                    <form class="bg-gray-500 shadow-md rounded px-8 pt-6 pb-8 mb-4" accept="{{ route('chats.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-white text-sm font-bold mb-2" for="message">
                                Message
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="message" id="message" type="text" placeholder="Write Message Here">
                        </div>
                        <div class="flex items-center justify-between">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                Send
                            </button>
                        </div>
                    </form>
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
