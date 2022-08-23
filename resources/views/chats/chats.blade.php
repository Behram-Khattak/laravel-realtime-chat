<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chats') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-indigo-300 overflow-hidden shadow-xl sm:rounded-lg">
                {{-- <div class="card m-5">
                    <div class="card-body px-20">
                            @foreach ($chats as $chat)
                                @if ($chat->sender_id == auth()->user()->id)
                                    <div class="bg-white rounded py-1 px-2 inline-block">
                                        <div class="flex">
                                            <div class="user_avatar">
                                                <img class="rounded-full" width="60" src="{{ asset('build/assets/images/ac45e6a1-028e-49f5-b4ec-2ad554abda73.jpg') }}" alt="user-avatar">
                                            </div>
                                            <div class="user_msg-info py-4 px-4">
                                                <b class="card-text">{{ $chat->sender_name }}</b>
                                                <p class="card-text">
                                                    {{ $chat->message }}
                                                </p>
                                            </div>
                                        </div>
                                    </div><br>
                                    @else
                                    <div class="bg-white rounded py-1 px-2 mt-5 inline-block float-right">
                                        <div class="flex">
                                            <div class="user_msg-info py-4 px-4">
                                                <b class="card-text float-right">{{ $chat->sender_name }}</b><br>
                                                <p class="card-text">
                                                    {{ $chat->message }}
                                                </p>
                                            </div>
                                            <div class="user_avatar">
                                                <img class="rounded-full" width="60" src="{{ asset('build/assets/images/ac45e6a1-028e-49f5-b4ec-2ad554abda73.jpg') }}" alt="user-avatar">
                                            </div>
                                        </div>
                                    </div><br>
                                @endif
                            @endforeach
                    </div>
                </div> --}}

                <div class="container mx-auto">
                    <div class="border rounded">
                      <div>
                        <div class="w-full">
                          <div class="relative flex items-center p-3 border-b border-gray-300">
                            <span class="block ml-2 font-bold text-gray-600">Lets Chat</span>
                          </div>
                          <div class="relative w-full p-6 overflow-y-auto">

                            <ul class="space-y-2">
                                @foreach ($chats as $chat)
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
                                @endforeach
                            </ul>

                          </div>

                          <div class="flex items-center justify-between w-full p-3 border-t border-gray-300">
                            <form action="{{ route('chats.store') }}" method="POST">
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

                {{-- <div class="m-10">
                    <form class="px-8 pt-6 pb-8 mb-4" action="{{ route('chats.store') }}" method="POST">
                        @csrf
                            <div class="flex">
                                <input class="shadow appearance-none border-none rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="message" id="message" type="text" placeholder="Write Message Here">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 ml-2 rounded-full focus:outline-none focus:shadow-outline" type="submit">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                    </form>
                </div> --}}
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
