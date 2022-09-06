<div x-data="{ openCart: false }" @keydown.escape="openCart = false">
    <!-- start:: Wide Info Modal -->
    <div class="space-y-4 relative mx-6 shrink-0 flex items-center">
        <button 
            @click="openCart = !openCart"
            class="cursor-pointer flex"
        >
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" class="fill-violet-500" width="24" height="24" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 122.9 107.5" xml:space="preserve"><g><path d="M3.9,7.9C1.8,7.9,0,6.1,0,3.9C0,1.8,1.8,0,3.9,0h10.2c0.1,0,0.3,0,0.4,0c3.6,0.1,6.8,0.8,9.5,2.5c3,1.9,5.2,4.8,6.4,9.1 c0,0.1,0,0.2,0.1,0.3l1,4H119c2.2,0,3.9,1.8,3.9,3.9c0,0.4-0.1,0.8-0.2,1.2l-10.2,41.1c-0.4,1.8-2,3-3.8,3v0H44.7 c1.4,5.2,2.8,8,4.7,9.3c2.3,1.5,6.3,1.6,13,1.5h0.1v0h45.2c2.2,0,3.9,1.8,3.9,3.9c0,2.2-1.8,3.9-3.9,3.9H62.5v0 c-8.3,0.1-13.4-0.1-17.5-2.8c-4.2-2.8-6.4-7.6-8.6-16.3l0,0L23,13.9c0-0.1,0-0.1-0.1-0.2c-0.6-2.2-1.6-3.7-3-4.5 c-1.4-0.9-3.3-1.3-5.5-1.3c-0.1,0-0.2,0-0.3,0H3.9L3.9,7.9z M96,88.3c5.3,0,9.6,4.3,9.6,9.6c0,5.3-4.3,9.6-9.6,9.6 c-5.3,0-9.6-4.3-9.6-9.6C86.4,92.6,90.7,88.3,96,88.3L96,88.3z M53.9,88.3c5.3,0,9.6,4.3,9.6,9.6c0,5.3-4.3,9.6-9.6,9.6 c-5.3,0-9.6-4.3-9.6-9.6C44.3,92.6,48.6,88.3,53.9,88.3L53.9,88.3z M33.7,23.7l8.9,33.5h63.1l8.3-33.5H33.7L33.7,23.7z"/></g></svg>

            {{-- <svg xmlns="http://www.w3.org/2000/svg" class="fill-gray-100" width="24" height="24" viewBox="0 0 24 24"><path d="M19.029 13h2.971l-.266 1h-2.992l.287-1zm.863-3h2.812l.296-1h-2.821l-.287 1zm-.576 2h4.387l.297-1h-4.396l-.288 1zm2.684-9l-.743 2h-1.929l-3.474 12h-11.239l-4.615-11h14.812l-.564 2h-11.24l2.938 7h8.428l3.432-12h4.194zm-14.5 15c-.828 0-1.5.672-1.5 1.5 0 .829.672 1.5 1.5 1.5s1.5-.671 1.5-1.5c0-.828-.672-1.5-1.5-1.5zm5.9-7-.9 7c-.828 0-1.5.671-1.5 1.5s.672 1.5 1.5 1.5 1.5-.671 1.5-1.5c0-.828-.672-1.5-1.5-1.5z"/></svg> --}}
            <sub>
                @if (!Cart::session(auth()->user()->id)->isEmpty())
                <span
                    class="bg-red-600 text-gray-100 px-1.5 py-0.5 rounded-full -ml-1 animate-pulse"
                >
                    {{ count(Cart::session(auth()->user()->id)->getContent()) }}
                </span>
                @endif
            </sub>
        </button>
    </div>
    <!-- end:: Wide Info Modal -->
    <!-- start:: Wide Info Modal -->
    <div 
        x-show="openCart" 
        x-transition.opacity
        x-transition:enter.duration.100ms
        x-transition:leave.duration.300ms
        x-cloak
        class="fixed top-0 left-0 z-50 bg-black bg-opacity-70 h-screen w-full flex items-center justify-center"
    >
        <div 
            @click.away="openCart = false" 
            class="relative w-5/6 md:w-3/4 lg:w-2/3 xl:w-1/2 bg-white p-10 rounded-lg shadow-xl"
        >
            <span 
                @click="openCart = false"
                class="absolute right-2 top-1 text-xl cursor-pointer hover:text-gray-600"
                title="Close"
            >
                &#x2715
            </span>
            <div class="px-2">

                <!-- start::Header Rounded Top -->
                
                <h4 class="text-xl font-semibold">{{ auth()->user()->name }}'s Cart</h4>
                @if (!Cart::session(auth()->user()->id)->isEmpty())
                <table class="w-full whitespace-nowrap my-4">
                    <thead class="border-b border-gray-300 bg-gray-800 text-gray-100">
                        <td class="p-2 rounded-tl-lg"></td>
                        <td class="p-2">Product name</td>
                        <td class="p-2">Price</td>
                        <td class="p-2 rounded-tr-lg">Quantity</td>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr
                            class="border-b border-gray-200"
                        >
                            <td class="p-2">
                                <button
                                    wire:click="selectProduct({{ $item->id }}, 'delete')"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500 hover:text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </td>
                            <td class="p-2">
                                @if (!empty($item->associatedModel->product_img))
                                    <img width="70px" src="{{ url('storage/products_thumb/'. $item->associatedModel->product_img) }}" />
                                @else
                                    No profile image available!
                                @endif
                                {{ $item->name }}
                            </td>
                            <td class="p-2">&#8369;{{ Cart::get($item->id)->getPriceSum() }}</td>
                            <td class="p-2">
                                @error('qty'.$item->id) <span class="bg-red-200 text-red-600 px-2 py-1 text-sm rounded">{{ $message }}</span> @enderror
                                <div class="flex items-center mt-1">
                                    <button
                                        class="text-gray-500 focus:outline-none focus:text-gray-600"
                                        wire:click="selectProduct({{ $item->id }}, 'Increment')"
                                    >
                                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </button>
                                    <span class="text-gray-700 text-lg mx-2">{{ $item->quantity }}</span>
                                    <button
                                        wire:click="selectProduct({{ $item->id }}, 'Decrement')"
                                        class="text-gray-500 focus:outline-none focus:text-gray-600"
                                    >
                                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                                Total: &#8369;{{ Cart::session(auth()->user()->id)->getSubTotal() }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- end::Header Rounded Top -->
                <!-- start::Default Buttons Colors Secondary -->
                <button
                    wire:click="checkout"
                    class="bg-secondary hover:bg-secondary-dark rounded-full px-6 py-1.5 text-gray-100 hover:shadow-xl transition duration-150"
                >
                    Checkout
                </button>
                <!-- end::Default Buttons Colors Secondary -->

                @else
                    Your cart is empty.
                @endif
            </div>
        </div>
    </div>
    <!-- end:: Wide Info Modal -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
</div>
