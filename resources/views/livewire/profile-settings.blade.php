<div>
    <div class="py-2 border-b">
        <div x-data="{ openSettings: false }" @keydown.escape="openSettings = false">
            <p class="text-gray-400 text-xs px-6 uppercase mb-1">Profile</p>
            <button
                @click="openSettings = !openSettings"
                class="w-full flex items-center py-1.5 px-6 space-x-2 hover:bg-gray-200"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm text-gray-700">Settings</span>
            </button>

            <!-- start:: Wide Info Modal -->
            <div 
                x-show="openSettings" 
                x-transition.opacity
                x-transition:enter.duration.100ms
                x-transition:leave.duration.300ms
                x-cloak
                class="fixed top-0 left-0 z-50 bg-black bg-opacity-70 h-screen w-full flex items-center justify-center"
            >
                <div 
                    @click.away="openSettings = false" 
                    class="relative w-5/6 md:w-3/4 lg:w-2/3 xl:w-1/2 bg-white p-10 rounded-lg shadow-xl"
                >
                    <span 
                        @click="openSettings = false"
                        class="absolute right-2 top-1 text-xl cursor-pointer hover:text-gray-600"
                        title="Close"
                    >
                        &#x2715
                    </span>
                    <div class="px-2">

                        <!-- start::Header Rounded Top -->
                        
                        <h4 class="text-xl font-semibold">{{ auth()->user()->name }}'s Settings</h4>

                        <div class="mt-6 grid gap-6">
                            <!-- start::Input With Icons Username -->
                            <div class="flex flex-col">
                                <div class="flex items-center mt-2">
                                    <input 
                                        type="text" 
                                        name="input_icon_username" 
                                        id="input_icon_username" 
                                        class="flex-1 py-1 border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300" 
                                        placeholder="Name"
                                        wire:model="name"
                                    >
                                    <span class="w-14 h-full bg-primary flex items-center justify-center">
                                        <svg class="w-4 h-4 text-gray-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </span>
                                </div>
                            </div>
                            @error('name')
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror
                            <!-- end::Input With Icons Username -->
                            <!-- start::Input With Icons Location -->
                            <div class="flex flex-col">
                                <div class="flex items-center mt-2">
                                    <input 
                                        type="text" 
                                        name="input_icon_address" 
                                        id="input_icon_address" 
                                        class="flex-1 py-1 border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300" 
                                        placeholder="Address"
                                        wire:model="address"
                                    >
                                    <span class="w-14 h-full bg-primary flex items-center justify-center">
                                        <svg class="w-5 h-5 text-gray-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </span>
                                </div>
                            </div>
                            @error('address')
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror
                            <div class="flex flex-col">
                                <div class="flex items-center mt-2">
                                    <input 
                                        type="text" 
                                        name="input_icon_city" 
                                        id="input_icon_city" 
                                        class="flex-1 py-1 border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300" 
                                        placeholder="City"
                                        wire:model="city"
                                    >
                                    <span class="w-14 h-full bg-primary flex items-center justify-center">
                                        <svg class="w-5 h-5 text-gray-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </span>
                                </div>
                            </div>
                            @error('city')
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror
                            <div class="flex flex-col">
                                <div class="flex items-center mt-2">
                                    <input 
                                        type="text" 
                                        class="flex-1 py-1 border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300" 
                                        placeholder="State"
                                        wire:model="state"
                                    >
                                    <span class="w-14 h-full bg-primary flex items-center justify-center">
                                        <svg class="w-5 h-5 text-gray-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </span>
                                </div>
                            </div>
                            @error('state')
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror
                            <!-- end::Input With Icons Location -->
                            <!-- start::Input With Icons Phone -->
                            <div class="flex flex-col">
                                <div class="flex items-center mt-2">
                                    <input 
                                        type="text" 
                                        class="flex-1 py-1 border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300" 
                                        placeholder="Contact no."
                                        wire:model="phone"
                                    >
                                    <span class="w-14 h-full bg-primary flex items-center justify-center">
                                        <svg class="w-5 h-5 text-gray-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    </span>
                                </div>
                            </div>
                            @error('phone')
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror
                            <!-- end::Input With Icons Phone -->
                            <!-- start::Input With Icons Info -->
                            <div class="flex flex-col">
                                <div class="flex items-center mt-2">
                                    <input 
                                        type="text"
                                        id="date" 
                                        class="flex-1 py-1 border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300" 
                                        placeholder="MM/DD/YYYY"
                                        wire:model.lazy="date"
                                    >
                                    <span class="w-14 h-full bg-primary flex items-center justify-center">
                                        <svg class="w-5 h-5 text-gray-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </span>
                                </div>
                            </div>
                            @error('date')
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror
                            <!-- end::Input With Icons Info -->

                            <!-- start::Input With Icons Email -->
                            <div class="flex flex-col">
                                <div class="flex items-center mt-2">
                                    <input 
                                        type="email" 
                                        class="flex-1 py-1 border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300" 
                                        placeholder="Email"
                                        wire:model="email"
                                    >
                                    <span class="w-14 h-full bg-primary flex items-center justify-center">
                                        <svg class="w-4 h-4 text-gray-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                                    </span>
                                </div>
                            </div>

                            @error('date')
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror
                            <!-- end::Input With Icons Info -->

                            <!-- start::Input With Icons Email -->
                            <div class="flex flex-col">
                                <div class="flex items-center mt-2">
                                    {{-- @if ($profileImage)
                                        <img width="100px" src="{{ $profileImage->temporaryUrl() }}">
                                    @endif --}}
                                    <input
                                        class="flex-1 py-1 border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300" 
                                        placeholder="Image"
                                        type="file" 
                                        id="upload{{ $iteration }}"
                                        wire:model="profileImage"
                                        {{-- x-on:click="$wire.emit('forcedClear')" --}}
                                    >
                                    <span class="w-14 h-full bg-primary flex items-center justify-center">
                                        <svg class="w-4 h-4 text-gray-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                                    </span>
                                </div>
                            </div>
                            
                            @error('email')
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror
                            <!-- end::Input With Icons Email -->

                            <!-- start::Input Show/Hide Password -->
                            @if (auth()->user()->email != $email)
                                <div class="flex flex-col">
                                    <div 
                                        x-data="{ show: false }"
                                        class="relative flex items-center mt-2"
                                    >
                                        <input 
                                            :type=" show ? 'text': 'password' "
                                            class="flex-1 py-1 pr-10 border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300" 
                                            placeholder="Current Password"
                                            wire:model="current_password"
                                        >
                                        <button type="button" class="absolute right-2 bg-transparent flex items-center justify-center" @click="show = !show">
                                            <svg x-show="!show"  class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>

                                            <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </button>
                                    </div>
                                </div>
                                @error('current_password')
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror
                            @endif
                            <!-- end::Input Show/Hide Password -->
                        </div>
                        <br>
                        <!-- start::Default Buttons Colors Secondary -->
                        <button
                            wire:click="save"
                            x-on:close-modal.window="openSettings = false"
                            class="bg-secondary hover:bg-secondary-dark rounded-full px-6 py-1.5 text-gray-100 hover:shadow-xl transition duration-150"
                        >
                            Save
                        </button>
                        <!-- end::Default Buttons Colors Secondary -->
                    </div>
                </div>
            </div>
            <!-- end:: Wide Info Modal -->
        </div>
    </div>
    @section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
    <script>
        new Pikaday({
            field: document.getElementById('date'),
            format: 'YYYY-MM-DD'
        })
    </script>
    @endsection
</div>
