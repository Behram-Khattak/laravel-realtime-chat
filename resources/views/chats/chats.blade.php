<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chats') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-indigo-300 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="card m-5">
                    <div class="card-body px-20">
                            {{-- @foreach ($chats as $chat)
                                @if ($chat->sender_id == auth()->user()->id) --}}
                                    <div class="bg-white rounded py-1 px-2 inline-block">
                                        <div class="flex">
                                            <div class="user_avatar mr-1">
                                                <img src="{{ asset('build/assets/images/ac45e6a1-028e-49f5-b4ec-2ad554abda73.jpg') }}" alt="user-avatar">
                                            </div>
                                            <div class="user_msg-info py-4 px-4">
                                                <b class="card-text">sender_name</b>
                                                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias sunt illo culpa dolorum eos ut inventore harum aut maiores! Incidunt enim expedita deleniti quos culpa deserunt libero voluptas facere suscipit.</p>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- @else --}}
                                    {{-- <div class="flex bg-white rounded-full">
                                        <b class="card-text">sender_name</b>
                                        <p class="card-text">message</p>
                                    </div> --}}
                                {{-- @endif
                            @endforeach --}}
                    </div>
                </div>

                <div class="m-10">
                    <form class="px-8 pt-6 pb-8 mb-4" accept="{{ route('chats.store') }}" method="POST">
                        @csrf
                            <div class="flex">
                                <input class="shadow appearance-none border-none rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="message" id="message" type="text" placeholder="Write Message Here">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 ml-2 rounded-full focus:outline-none focus:shadow-outline" type="submit">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
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
