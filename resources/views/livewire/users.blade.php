<div x-data="{ 'open': @entangle('show') }" @keydown.escape="open = false">
    
    {{-- USER MODAL --}}

    <!-- start:: Basic Sign In Modal -->
    <div 
        x-show="open"
        x-transition.opacity
        x-transition:enter.duration.100ms
        x-transition:leave.duration.300ms
        x-cloak
        class="fixed top-0 left-0 z-50 bg-black bg-opacity-70 h-screen w-full flex items-center justify-center"
    >
        <div 
            @click.away="open = false" 
            class="relative w-3/4 sm:w-2/3 md:w-1/2 lg:w-1/3 xl:w-1/4 bg-white p-10 rounded-lg shadow-xl"
        >
            <span 
                @click="open = false"
                class="absolute right-2 top-1 text-xl cursor-pointer hover:text-gray-600" 
                title="Close"
            >
                &#x2715
            </span>
            @if ($viewModal == 'createUpdate')
                @livewire('create-users')
            @else
                <p class="text-center text-lg">Are you sure you want to delete? {{ $currentName }}</p>
                <div class="flex items-center justify-center space-x-4 mt-6">
                    <div>
                        <button 
                            wire:click="delete()"
                            x-on:close-modal.window="open = false"
                            class="bg-green-500 hover:bg-green-600 w-20 py-1 text-gray-100 rounded transition duration-150"
                        >
                            Yes
                        </button>
                    </div>
                    <button 
                        @click="open = false"
                        class="bg-red-500 hover:bg-red-600 w-20 py-1 text-gray-100 rounded transition duration-150"
                    >
                        No
                    </button>
                </div>
            @endif
        </div>
    </div>
    <!-- end:: Basic Sign In Modal -->
    
    {{-- USER TABLE --}}
    <div class="w-full overflow-x-auto">
        <div class="flex flex-col mt-8">
            <!-- start::Advance Table Manage Icons -->
            <div class="bg-white rounded-lg px-8 py-6 overflow-x-scroll custom-scrollbar mb-12">
                <h4 class="text-xl font-semibold">Users List</h4>
                <!-- start:: Basic Sign In Modal -->
                
                <!-- end:: Basic Sign In Modal -->
                
                <div class="mt-4 flex items-left justify-left space-x-4">
                    <form class="relative flex items-center">
                        <input 
                            type="search"
                            wire:model="searchTerm"
                            name="input_search_without_btn" 
                            id="input_search_without_btn" 
                            class="flex-1 py-0.5 pl-10 border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300" 
                            placeholder="Search..."
                        >
                        <span class="absolute left-2 bg-transparent flex items-center justify-center" @click="show = !show">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </span>
                    </form>
                    <div class="space-y-4">
                        <button 
                            wire:click="createUpdateModal"
                            x-on:click="$wire.emit('forcedCloseModal')"
                            class="bg-green-500 hover:bg-green-600 rounded-full px-6 py-1.5 text-gray-100 hover:shadow-xl transition duration-150"
                        >
                            Create
                        </button>
                    </div>
                </div>

                <table class="w-full my-8 whitespace-nowrap">
                    <thead class="bg-secondary text-gray-100 font-bold">
                        <td class="py-2 pl-2">
                            Profile Image
                        </td>
                        <td class="py-2 pl-2">
                            Customer Name
                        </td>
                        <td class="py-2 pl-2">
                            Email
                        </td>
                        <td class="py-2 pl-2">
                            Status
                        </td>
                        <td class="py-2 pl-2">
                            Created Date
                        </td>
                        <td class="py-2 pl-2">
                            Action
                        </td>
                    </thead>
                    <tbody class="text-sm">
                        @if (count($users))
                            @foreach($users as $user)
                            <tr class="bg-gray-100 hover:bg-primary hover:bg-opacity-20 transition duration-200">
                                <td class="py-3 pl-2">
                                    @if (!empty($user->profile_img))
                                        @if ($user->profile_img == "default.png")
                                            <img width="100px" src="{{ url('default_image/'. $user->profile_img) }}" />
                                        @else
                                            <img width="100px" src="{{ url('storage/photos_thumb/'. $user->profile_img) }}" />
                                        @endif
                                    @else
                                        No profile image available!
                                    @endif
                                </td>
                                <td class="py-3 pl-2">
                                    {{ $user->name }}
                                    
                                    @if ($user->role->id == '3')
                                        {{-- BADGE --}}
                                        <svg
                                            id="Layer_1"
                                            data-name="Layer 1"
                                            class="h-6 w-6"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 107.87 122.88"
                                        >
                                            <defs>
                                                <style>
                                                    .cls-1{fill:#2b2a29;}.cls-1,.cls-2{fill-rule:evenodd;}.cls-2{fill:#10a64a;}
                                                </style>
                                            </defs>
                                            <title>Staff</title>
                                            <path 
                                                class="cls-1"
                                                d="M53.75,0C73.86,12.75,92,18.78,107.63,17.35c1.18,23.9-2,43.55-8.89,59.25a28.9,28.9,0,0,0-6.38-3.81c5.5-13.1,8-29.35,7-49C86.19,25,70.8,19.89,53.78,9.09,39,20.54,23.84,23.89,8.34,23.08,7.65,49.25,12.25,69,21.14,83.3c6.57-5.49,17.76-4.67,23-12a2.48,2.48,0,0,0,.56-1.11c0-.13-5.75-7.18-6.27-8-1.35-2.15-3.89-5.08-3.89-7.6A4.07,4.07,0,0,1,37.32,51c-.12-2.14-.2-4.3-.2-6.44,0-1.27,0-2.55.07-3.81a9.07,9.07,0,0,1,.42-1.91,13.57,13.57,0,0,1,6-7.68,16.75,16.75,0,0,1,3.28-1.57c2.08-.76,1.07-4,3.35-4.08,5.32-.14,14.08,4.51,17.49,8.21A12.45,12.45,0,0,1,71.27,42l-.22,9.32a3,3,0,0,1,2.23,1.92c.73,2.94-2.32,6.6-3.74,8.94-1.31,2.16-6.31,8.06-6.31,8.1,0,.26.1.57.45,1.09a13.51,13.51,0,0,0,2.87,2.88,28.86,28.86,0,0,0-5.76,4.35l-.32.29a28.84,28.84,0,0,0-2.45,38c-1.33.58-2.68,1.13-4.06,1.65C19.14,105.84-1.45,74.71.08,16.52c18.31,1,36.27-3,53.67-16.52Z"
                                            />
                                            <path
                                                class="cls-2"
                                                d="M80.88,75.69a23.6,23.6,0,1,1-23.59,23.6,23.61,23.61,0,0,1,23.59-23.6ZM74.14,95.87l3.57,3.34L87,89.74c.82-.83,1.34-1.5,2.35-.46l3.27,3.36c1.08,1.06,1,1.69,0,2.68L79.58,108.19c-2.14,2.1-1.77,2.23-3.94.07l-7-7a1,1,0,0,1,.09-1.47l3.81-3.94c.57-.61,1-.56,1.62,0Z"
                                            />
                                        </svg>
                                    @endif
                                </td>
                                <td class="py-3 pl-2 capitalize">
                                    {{ $user->email }}
                                </td>
                                <td class="py-3 pl-2">
                                    @if ($user->email_verified_at == null)
                                        <span class="bg-red-500 px-1.5 py-0.5 rounded-lg text-gray-100">Not Verified</span>
                                    @else
                                        <span class="bg-green-500 px-1.5 py-0.5 rounded-lg text-gray-100">Approved</span>
                                    @endif
                                </td>
                                <td class="py-3 pl-2">
                                    {{ $user->created_at }}
                                </td>
                                <td class="py-3 pl-2 items-center space-x-2">
                                    <button
                                        wire:click="selectUser({{ $user->id }}, 'update')"
                                        x-on:click="$wire.emit('forcedCloseModal')"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-500 hover:text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <button
                                        wire:click="selectUser({{ $user->id }}, 'delete')"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500 hover:text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr class="bg-gray-100 hover:bg-blue-500 hover:bg-opacity-20 transition duration-200">
                                <td class="py-3 pl-2 flex items-center space-x-2">
                                    <h2>No Results Found!</h2>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
            <!-- end::Advance Table Manage Icons -->
        </div>
    </div>
</div>