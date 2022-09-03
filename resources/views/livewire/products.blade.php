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
                @livewire('create-products')
            @else
                <p class="text-center text-lg">Are you sure you want to delete? {{ $currentProductName }}</p>
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
                <h4 class="text-xl font-semibold">Products List</h4>
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
                            Image
                        </td>
                        <td class="py-2 pl-2">
                            Category
                        </td>
                        <td class="py-2 pl-2">
                            Product name
                        </td>
                        <td class="py-2 pl-2">
                            Price
                        </td>
                        <td class="py-2 pl-2">
                            Description
                        </td>
                        <td class="py-2 pl-2">
                            Created Date
                        </td>
                        <td class="py-2 pl-2">
                            Action
                        </td>
                    </thead>
                    <tbody class="text-sm">
                        @if (count($products))
                            @foreach($products as $product)
                            <tr class="bg-gray-100 hover:bg-primary hover:bg-opacity-20 transition duration-200">
                                <td class="py-3 pl-2">
                                    @if (!empty($product->product_img))
                                        @if ($product->product_img == "default.png")
                                            <img width="100px" src="{{ url('images/'. $product->product_img) }}" />
                                        @else
                                            <img width="100px" src="{{ url('storage/products_thumb/'. $product->product_img) }}" />
                                        @endif
                                    @else
                                        No profile image available!
                                    @endif
                                </td>
                                <td class="py-3 pl-2">
                                    {{ $product->category }}
                                </td>
                                <td class="py-3 pl-2 capitalize">
                                    {{ $product->product_name }}<br>
                                    Qty: <span class="text-blue-500 ring-1 ring-orange-500 text-sm rounded">{{ $product->qty }}</span>
                                    
                                </td>
                                <td class="py-3 pl-2 capitalize">
                                    &#8369;{{ $product->price }}
                                </td>
                                <td class="py-3 pl-2 capitalize">
                                    {{ $product->desc }}
                                </td>
                                <td class="py-3 pl-2">
                                    {{ $product->created_at->format('d M Y - H:i a') }}
                                </td>
                                <td class="py-3 pl-2 items-center space-x-2">
                                    <button
                                        wire:click="selectProduct({{ $product->id }}, 'update')"
                                        x-on:click="$wire.emit('forcedCloseModal')"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-500 hover:text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <button
                                        wire:click="selectProduct({{ $product->id }}, 'delete')"
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
                {{ $products->links() }}
            </div>
            <!-- end::Advance Table Manage Icons -->
        </div>
    </div>
</div>