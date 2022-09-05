<div>
    <!-- start:Page content -->
    <div class="bg-white rounded-lg shadow-xl pb-8">
        <div class="absolute">
            <div x-data="{ profile: false }" class="pl-5 mt-4 rounded">
                <button
                    @click="profile = !profile" 
                    class="border border-gray-400 p-2 rounded text-gray-300 hover:text-gray-300 bg-gray-100 bg-opacity-10 hover:bg-opacity-20"
                    title="Profile"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                    </svg>
                </button>
                <div
                    x-show="profile" 
                    x-cloak
                    @click.away="profile = false"
                    class="bg-white absolute left-1 w-40 py-2 mt-1 border border-gray-200 shadow-2xl"
                >
                    @livewire('profile-settings')

                    @livewire('change-password')
                </div>
            </div>
        </div>
        <div class="w-full h-[250px]">
            @if (!empty(auth()->user()->profile_img))
                @if (auth()->user()->profile_img === "default.png")
                    <img src="{{ url('default_image/' . auth()->user()->profile_img) }}" class="w-full h-full rounded-tl-lg rounded-tr-lg" />
                @else
                    <img src="{{ url('storage/photos_thumb/' . auth()->user()->profile_img) }}" class="w-full h-full rounded-tl-lg rounded-tr-lg" />
                @endif
            @else
            @endif
        </div>
        <div class="flex flex-col items-center -mt-20">
            @if (!empty(auth()->user()->profile_img))
                @if (auth()->user()->profile_img === "default.png")
                    <img src="{{ url('default_image/' . auth()->user()->profile_img) }}" class="w-40 border-4 border-white rounded-full" />
                @else
                    <img src="{{ url('storage/photos_thumb/' . auth()->user()->profile_img) }}" class="w-50 rounded-full max-w-full h-auto align-middle border-none" />
                @endif
            @else
                No profile image available!
            @endif
            <div class="flex items-center space-x-2 mt-2">
                <p class="text-2xl">{{ auth()->user()->name }}</p>

                @if (auth()->user()->email_verified_at == NULL)
                <span title="NotVerified">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" class="text-gray-100 h-6 w-6" viewBox="0 0 122.879 122.879" enable-background="new 0 0 122.879 122.879" xml:space="preserve">
                        <g>
                            <path fill-rule="evenodd" clip-rule="evenodd" fill="#FF4141" d="M61.44,0c33.933,0,61.439,27.507,61.439,61.439 s-27.506,61.439-61.439,61.439C27.507,122.879,0,95.372,0,61.439S27.507,0,61.44,0L61.44,0z M73.451,39.151 c2.75-2.793,7.221-2.805,9.986-0.027c2.764,2.776,2.775,7.292,0.027,10.083L71.4,61.445l12.076,12.249 c2.729,2.77,2.689,7.257-0.08,10.022c-2.773,2.765-7.23,2.758-9.955-0.013L61.446,71.54L49.428,83.728 c-2.75,2.793-7.22,2.805-9.986,0.027c-2.763-2.776-2.776-7.293-0.027-10.084L51.48,61.434L39.403,49.185 c-2.728-2.769-2.689-7.256,0.082-10.022c2.772-2.765,7.229-2.758,9.953,0.013l11.997,12.165L73.451,39.151L73.451,39.151z"/>
                        </g>
                    </svg>
                </span>
                @else
                    <span class="bg-blue-500 rounded-full p-1" title="Verified">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-100 h-2.5 w-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7" />
                        </svg>
                    </span>
                @endif
            </div>
            <p class="text-gray-700">{{ auth()->user()->role->name }} at Klight Apparel & Clothing</p>
            <p class="text-sm text-gray-500">{{ auth()->user()->city }}, {{ auth()->user()->state }}</p>
        </div>
        {{-- <div class="flex-1 flex flex-col items-center lg:items-end justify-end px-8 mt-2">
            <div class="flex items-center space-x-4 mt-2">
                <button class="flex items-center bg-blue-600 hover:bg-blue-700 text-gray-100 px-4 py-2 rounded text-sm space-x-2 transition duration-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                    </svg>
                    <span>Connect</span>
                </button>
                <button class="flex items-center bg-blue-600 hover:bg-blue-700 text-gray-100 px-4 py-2 rounded text-sm space-x-2 transition duration-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd" />
                    </svg>
                    <span>Message</span>
                </button>
            </div>
        </div> --}}
    </div>

    <div class="my-4 flex flex-col 2xl:flex-row space-y-4 2xl:space-y-0 2xl:space-x-4">
        <div class="w-full flex flex-col 2xl:w-1/3">
            <div class="flex-1 bg-white rounded-lg shadow-xl p-8">
                <h4 class="text-xl text-gray-900 font-bold">Personal Info</h4>
                <ul class="mt-2 text-gray-700">
                    <li class="flex border-y py-2">
                        <span class="font-bold w-24">Full name:</span>
                        <span class="text-gray-700">{{ auth()->user()->name }}</span>
                    </li>
                    <li class="flex border-b py-2">
                        <span class="font-bold w-24">Birthday:</span>
                        <span class="text-gray-700">
                            @if(auth()->user()->birthday == NULL)
                                Not Found
                            @else
                            {{ date("d M Y", strtotime(auth()->user()->birthday)); }}
                            @endif
                        </span>
                    </li>
                    <li class="flex border-b py-2">
                        <span class="font-bold w-24">Joined:</span>
                        <span class="text-gray-700">{{ auth()->user()->created_at->format('jS F Y g:i A') }}</span>
                    </li>
                    <li class="flex border-b py-2">
                        <span class="font-bold w-24">Mobile:</span>
                        <span class="text-gray-700">
                            @if(auth()->user()->contact_no == NULL)
                                Not Found
                            @else
                                {{ auth()->user()->contact_no }}
                            @endif
                        </span>
                    </li>
                    <li class="flex border-b py-2">
                        <span class="font-bold w-24">Email:</span>
                        <span class="text-gray-700">{{ auth()->user()->email }}</span>
                    </li>
                    <li class="flex border-b py-2">
                        <span class="font-bold w-24">Location:</span>
                        <span class="text-gray-700">
                            @if (auth()->user()->address == NULL)
                                Not Found
                            @else
                                {{ auth()->user()->address }} {{ auth()->user()->city }}, {{ auth()->user()->state }}
                            @endif
                        </span>
                    </li>
                </ul>
            </div>
            <div class="flex-1 bg-white rounded-lg shadow-xl mt-4 p-8">
                <h4 class="text-xl text-gray-900 font-bold">Activity log</h4>
                <div class="relative px-4">
                    <div class="absolute h-full border border-dashed border-opacity-20 border-secondary"></div>

                    <!-- start::Timeline item -->
                    <div class="flex items-center w-full my-6 -ml-1.5">
                        <div class="w-1/12">
                            <div class="w-3.5 h-3.5 bg-primary rounded-full"></div>
                        </div>
                        <div class="w-11/12">
                            <p class="text-sm">Profile informations changed.</p>
                            <p class="text-xs text-gray-500">3 min ago</p>
                        </div>
                    </div>
                    <!-- end::Timeline item -->

                    <!-- start::Timeline item -->
                    <div class="flex items-center w-full my-6 -ml-1.5">
                        <div class="w-1/12">
                            <div class="w-3.5 h-3.5 bg-primary rounded-full"></div>
                        </div>
                        <div class="w-11/12">
                            <p class="text-sm">
                                Connected with <a href="#" class="text-primary font-bold">Colby Covington</a>.</p>
                            <p class="text-xs text-gray-500">15 min ago</p>
                        </div>
                    </div>
                    <!-- end::Timeline item -->

                    <!-- start::Timeline item -->
                    <div class="flex items-center w-full my-6 -ml-1.5">
                        <div class="w-1/12">
                            <div class="w-3.5 h-3.5 bg-primary rounded-full"></div>
                        </div>
                        <div class="w-11/12">
                            <p class="text-sm">Invoice <a href="#" class="text-primary font-bold">#4563</a> was created.</p>
                            <p class="text-xs text-gray-500">57 min ago</p>
                        </div>
                    </div>
                    <!-- end::Timeline item -->

                    <!-- start::Timeline item -->
                    <div class="flex items-center w-full my-6 -ml-1.5">
                        <div class="w-1/12">
                            <div class="w-3.5 h-3.5 bg-primary rounded-full"></div>
                        </div>
                        <div class="w-11/12">
                            <p class="text-sm">
                                Message received from <a href="#" class="text-primary font-bold">Cecilia Hendric</a>.</p>
                            <p class="text-xs text-gray-500">1 hour ago</p>
                        </div>
                    </div>
                    <!-- end::Timeline item -->

                    <!-- start::Timeline item -->
                    <div class="flex items-center w-full my-6 -ml-1.5">
                        <div class="w-1/12">
                            <div class="w-3.5 h-3.5 bg-primary rounded-full"></div>
                        </div>
                        <div class="w-11/12">
                            <p class="text-sm">New order received <a href="#" class="text-primary font-bold">#OR9653</a>.</p>
                            <p class="text-xs text-gray-500">2 hours ago</p>
                        </div>
                    </div>
                    <!-- end::Timeline item -->

                    <!-- start::Timeline item -->
                    <div class="flex items-center w-full my-6 -ml-1.5">
                        <div class="w-1/12">
                            <div class="w-3.5 h-3.5 bg-primary rounded-full"></div>
                        </div>
                        <div class="w-11/12">
                            <p class="text-sm">
                                Message received from <a href="#" class="text-primary font-bold">Jane Stillman</a>.</p>
                            <p class="text-xs text-gray-500">2 hours ago</p>
                        </div>
                    </div>
                    <!-- end::Timeline item -->
                </div>
            </div>
        </div>
        <div class="flex flex-col w-full 2xl:w-2/3">
            <div class="flex-1 bg-white rounded-lg shadow-xl p-8">
                @livewire('user-order-log')
            </div>
        </div>
    </div>
    <!-- end:Page content -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
</div>
