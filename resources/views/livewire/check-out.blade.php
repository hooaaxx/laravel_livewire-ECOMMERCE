<div>
    @if (!Cart::session(auth()->user()->id)->isEmpty())
    <!-- start::Messagesss -->
    <div
        class="flex flex-col lg:flex-row space-y-4 lg:space-y-0 lg:space-x-4"
    >
        <div class="w-full lg:w-1/2 xl:w-2/3 2xl:w-3/4 rounded-lg h-full">
            <div
                class="flex items-center justify-center"
            >
                <!-- start:: Multiple Columns -->
                <div>
                    <h4 class="text-xl capitalize">Basic Details</h4>
                    <form>
                        <div class="grid grid-cols-2 gap-8">
                            <div class="flex flex-col my-4">
                                <label for="first_name_multiple_columns">Name</label>
                                <input 
                                    type="text" 
                                    name="first_name_multiple_columns" 
                                    id="first_name_multiple_columns" 
                                    class="flex-1 py-1 border-gray-300 mt-1 rounded focus:border-gray-300 focus:outline-none focus:ring-0" 
                                    placeholder="Your Name"
                                    wire:model="name"
                                >
                                @error('name')
                                    <span class="text-xs text-red-600 dark:text-red-400">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="flex flex-col my-4">
                                <label for="email_multiple_columns">Email</label>
                                <input 
                                    type="email" 
                                    name="email_multiple_columns" 
                                    id="email_multiple_columns" 
                                    class="flex-1 py-1 border-gray-300 mt-1 rounded focus:outline-none focus:ring-0 focus:border-gray-300" 
                                    placeholder="Your Email Address"
                                    wire:model="email"
                                >
                                @error('email')
                                    <span class="text-xs text-red-600 dark:text-red-400">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-8">
                            <div class="flex flex-col my-4">
                                <label for="address_multiple_columns">Address</label>
                                <input 
                                    type="text" 
                                    name="address_multiple_columns" 
                                    id="address_multiple_columns" 
                                    class="flex-1 py-1 border-gray-300 mt-1 rounded focus:outline-none focus:ring-0 focus:border-gray-300" 
                                    placeholder="Your Address"
                                    wire:model="address"
                                >
                                @error('address')
                                    <span class="text-xs text-red-600 dark:text-red-400">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="flex flex-col my-4">
                                <label for="city_multiple_columns">City</label>
                                <input 
                                    type="text" 
                                    name="city_multiple_columns" 
                                    id="city_multiple_columns" 
                                    class="flex-1 py-1 border-gray-300 mt-1 rounded focus:outline-none focus:ring-0 focus:border-gray-300" 
                                    placeholder="City"
                                    wire:model="city"
                                >
                                @error('city')
                                    <span class="text-xs text-red-600 dark:text-red-400">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="flex flex-col my-4">
                                <label for="state_multiple_columns">State</label>
                                <input 
                                    type="text" 
                                    name="state_multiple_columns" 
                                    id="state_multiple_columns" 
                                    class="flex-1 py-1 border-gray-300 mt-1 rounded focus:outline-none focus:ring-0 focus:border-gray-300" 
                                    placeholder="State"
                                    wire:model="state"
                                >
                                @error('state')
                                    <span class="text-xs text-red-600 dark:text-red-400">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="w-full lg:w-1/2 xl:w-1/3 2xl:w-1/4 bg-white rounded-lg h-full">
            <h5 class="flex items-center p-4 space-x-2 border-b-2">
                <span class="font-semibold">Order Details</span>
            </h5>
            <div class="my-4">
                <div class="grid grid-cols-1 md:grid-cols-1 xl:grid-cols-1 gap-10">
                    @foreach ($cartOrders as $order)

                    <div class="px-6 py-6 bg-white rounded-lg shadow-xl">
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-sm text-indigo-600">
                                {{ $order->name }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between mt-6">
                            x{{ $order->quantity }}
                            @error('qty'.$order->id) <span class="bg-red-200 text-red-600 px-2 py-1 text-sm rounded">{{ $message }}</span> @enderror
                            <div class="flex flex-col">
                                <div class="flex items-end">
                                    <span class="text-2xl 2xl:text-4xl font-bold">&#8369;{{ Cart::get($order->id)->getPriceSum() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @endforeach
                
                    <div class="grid grid-cols-2 md:grid-cols-2 xl:grid-cols-2 gap-10">
                        Shipping fee: &#8369;50
                        <br>
                        Total: &#8369;{{ Cart::session(auth()->user()->id)->getSubTotal() + 50 }}
                        <button
                            wire:click="placeOrder"
                            class="bg-primary hover:bg-primary-dark rounded-lg px-6 py-1.5 text-gray-100 hover:shadow-xl transition duration-150"
                        >
                            Cash on Delivery
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @else
        No checkout products
    @endif

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
</div>
