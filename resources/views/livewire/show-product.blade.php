<div>
    {{-- {{ dd(Cart::session(auth()->user()->id)->getContent()) }} --}}
    <!-- Main Content -->
    <main class="w-full flex flex-col lg:flex-row">
        <!-- Gallery -->
        {{-- @foreach ($products as $product)
            <section
                class="h-fit flex-col gap-8 mt-10 sm:flex sm:flex-row sm:gap-4 sm:h-full sm:mt-10 sm:mx-2 md:gap-8 md:mx-4 lg:flex-col lg:mx-0 lg:mt-10"
            >
                <picture
                    class="relative flex items-center bg-orange sm:bg-transparent"
                >
                    <button
                        class="bg-white w-10 h-10 flex items-center justify-center pr-1 rounded-full absolute left-6 z-10 sm:hidden"
                        id="previous-mobile"
                    >
                        <svg
                            width="12"
                            height="18"
                            xmlns="http://www.w3.org/2000/svg"
                            id="previous-mobile"
                        >
                            <path
                                d="M11 1 3 9l8 8"
                                stroke="#1D2026"
                                stroke-width="3"
                                fill="none"
                                fill-rule="evenodd"
                                id="previous-mobile"
                            />
                        </svg>
                    </button>
                    <img
                        src="{{ url('storage/products_thumb/'. $product->product_img) }}"
                        alt="sneaker"
                        class="block sm:rounded-xl xl:w-[70%] xl:rounded-xl m-auto pointer-events-none transition duration-300 lg:w-3/4 lg:pointer-events-auto lg:cursor-pointer lg:hover:shadow-xl"
                        id="hero"
                    />
                    <button
                        class="bg-white w-10 h-10 flex items-center justify-center pl-1 rounded-full absolute right-6 z-10 sm:hidden"
                        id="next-mobile"
                    >
                        <svg
                            width="13"
                            height="18"
                            xmlns="http://www.w3.org/2000/svg"
                            id="next-mobile"
                        >
                            <path
                                d="m2 1 8 8-8 8"
                                stroke="#1D2026"
                                stroke-width="3"
                                fill="none"
                                fill-rule="evenodd"
                                id="next-mobile"
                            />
                        </svg>
                    </button>
                </picture>

                <div
                    class="thumbnails hidden justify-between gap-4 m-auto sm:flex sm:flex-col sm:justify-start sm:items-center sm:h-fit md:gap-5 lg:flex-row"
                >
                    <div
                        id="1"
                        class="w-1/5 cursor-pointer rounded-xl sm:w-28 md:w-32 lg:w-[72px] xl:w-[78px] ring-active"
                    >
                        <img
                            src="{{ url('storage/products_thumb/'. $product->product_img) }}"
                            alt="thumbnail"
                            class="rounded-xl hover:opacity-50 transition active"
                            id="thumb-1"
                        />
                    </div>

                    <div
                        id="2"
                        class="w-1/5 cursor-pointer rounded-xl sm:w-28 md:w-32 lg:w-[72px] xl:w-[78px]"
                    >
                        <img
                            src="{{ url('storage/products_thumb/'. $product->product_img) }}"
                            alt="thumbnail"
                            class="rounded-xl hover:opacity-50 transition"
                            id="thumb-2"
                        />
                    </div>

                    <div
                        id="3"
                        class="w-1/5 cursor-pointer rounded-xl sm:w-28 md:w-32 lg:w-[72px] xl:w-[78px]"
                    >
                        <img
                            src="{{ url('storage/products_thumb/'. $product->product_img) }}"
                            alt="thumbnail"
                            class="rounded-xl hover:opacity-50 transition"
                            id="thumb-3"
                        />
                    </div>

                    <div
                        id="4"
                        class="w-1/5 cursor-pointer rounded-xl sm:w-28 md:w-32 lg:w-[72px] xl:w-[78px]"
                    >
                        <img
                            src="{{ url('storage/products_thumb/'. $product->product_img) }}"
                            alt="thumbnail"
                            class="rounded-xl hover:opacity-50 transition"
                            id="thumb-4"
                        />
                    </div>
                </div>
            </section>

            <section
                class="w-full p-6 lg:mt-10 lg:pr-20 lg:py-10 2xl:pr-40 2xl:mt-10"
            >
                <h4
                    class="font-bold text-orange mb-2 uppercase text-xs tracking-widest"
                >
                    {{ $product->category }}
                </h4>
                <h1
                    class="text-very-dark mb-4 font-bold text-3xl lg:text-4xl"
                >
                    {{ $product->product_name }}
                </h1>
                <p class="text-dark-grayish mb-6 text-base sm:text-lg">
                    {{ $product->desc }}
                </p>

                <div
                    class="flex items-center justify-between mb-6 sm:flex-col sm:items-start"
                >
                    <div class="flex items-center gap-4">
                        <h3
                            class="text-very-dark font-bold text-3xl inline-block"
                        >
                            &#8369;{{ $product->price }}
                        </h3>
                    </div>
                </div>

                <div class="flex flex-col gap-5 mb-16 sm:flex-row lg:mb-0">
                    @if(empty($cart))
                    
                        <div class="flex items-center mt-1">
                            <button
                                class="text-gray-500 focus:outline-none focus:text-gray-600"
                                wire:click="increment"
                            >
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </button>
                            <span class="text-gray-700 text-lg mx-2">{{ $counter }}</span>
                            <button
                                wire:click="decrement"
                                class="text-gray-500 focus:outline-none focus:text-gray-600"
                            >
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </button>
                        </div>
                        <button
                            wire:click="addToCart"
                            class="bg-green-500 hover:bg-green-600 rounded-full px-6 py-1.5 text-gray-100 hover:shadow-xl transition duration-150"
                        >
                            Add to cart
                        </button>
                    
                    @elseif ($cart->id == $product->id)
                        Already in cart
                    @endif
                </div>
                <br>
                @error('qty'.$product->id) <span class="bg-red-200 text-red-600 px-2 py-1 text-sm rounded">{{ $message }}</span> @enderror

            </section>
        @endforeach --}}

        @foreach ($products as $product)
            <div class="flex flex-col xl:flex-row space-y-12 xl:space-y-0 xl:space-x-12 bg-gray-200 px-4 py-8 rounded">
                <div class="w-full xl:w-1/3 h-full">
                    <div 
                        x-data="{ image: '{{ url('storage/products_thumb/'. $product->product_img) }}' }"
                        class="flex flex-col items-center justify-center"
                    >
                        <img :src="image" alt="Product Name">

                        <div class="flex items-cetnter justify-between space-x-2 mt-4">
                            <img 
                                @click="image = 'storage/products_thumb/'. {{$product->product_img}} "
                                src="{{ url('storage/products_thumb/'. $product->product_img) }}" 
                                alt="Product Name" 
                                class="w-20 xl:w-15 2xl:w-23 h-full border cursor-pointer hover:opacity-80"
                            >
                            <img 
                                @click="image = 'storage/products_thumb/'. {{$product->product_img}}"
                                src="{{ url('storage/products_thumb/'. $product->product_img) }}" 
                                alt="Product Name" 
                                class="w-20 xl:w-15 2xl:w-23 h-full border cursor-pointer hover:opacity-80"
                            >
                            <img 
                                @click="image = 'storage/products_thumb/'. {{$product->product_img}}"
                                src="{{ url('storage/products_thumb/'. $product->product_img) }}" 
                                alt="Product Name" 
                                class="w-20 xl:w-15 2xl:w-23 h-full border cursor-pointer hover:opacity-80"
                            >
                            <img 
                                @click="image = 'storage/products_thumb/'. {{$product->product_img}}"
                                src="{{ url('storage/products_thumb/'. $product->product_img) }}" 
                                alt="Product Name" 
                                class="w-20 xl:w-15 2xl:w-23 h-full border cursor-pointer hover:opacity-80"
                            >
                        </div>
                    </div>
                </div>
                <div class="w-full xl:w-3/5 h-full pl-12">
                    <p class="text-xl font-bold text-center lg:text-left">{{ $product->product_name }}</p>
                    {{-- <div class="flex items-center justify-center lg:justify-start mt-2 space-x-4">
                        <div class="flex items-center space-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-500" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-500" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-500" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-500" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </div>
                        <span class="text-sm text-gray-600">(143 Reviews)</span>
                    </div> --}}
                    <div class="mt-4 space-x-2 text-center lg:text-left">
                        <span class="text-3xl text-violet-900 font-bold">&#8369;{{ $product->price }}</span>
                    </div>
                    <div class="mt-4 text-sm text-center lg:text-left">
                        <span>Available: </span>
                        @if ($product->qty == 0)
                            <span class="text-red-500 font-bold">Out of stock</span>
                        @else
                            <span class="text-green-500 font-bold">In stock</span>
                        @endif
                        
                    </div>
                    <hr class="my-4">
                    <div class="text-center lg:text-left">
                        <span class="text-sm text-gray-500">{{ $product->desc }}</span>
                    </div>
                    <div class="mt-4 flex flex-col lg:flex-row items-center space-y-4 lg:space-y-0 lg:space-x-32">
                        <div>
                            <span class="text-gray-900">Sizes :</span>
                            <div class="text-sm text-primary mt-2">
                                <button class="bg-gray-500 hover:bg-gray-300 px-3 py-1.5 rounded-lg" title="Available">S</button>
                                <button class="bg-gray-500 hover:bg-gray-300 px-3 py-1.5 rounded-lg" title="Available">M</button>
                                <button class="bg-gray-500 hover:bg-gray-300 px-3 py-1.5 rounded-lg" title="Available">L</button>
                                <button class="bg-gray-500 text-gray-400 px-3 py-1.5 rounded-lg" title="Out of stock" disabled>XL</button>
                                <button class="bg-gray-500 text-gray-400 px-3 py-1.5 rounded-lg" title="Out of stock" disabled>XXL</button>
                            </div>
                        </div>
                        <div>
                            <span class="text-gray-900">Colors :</span>
                            <div class="flex mt-2">
                                <input type="radio" name="color" class="w-5 h-5 bg-black text-black border border-black m-1 focus:ring-0" value="black" title="black">
                                <input type="radio" name="color" class="w-5 h-5 bg-white text-white border border-gray-500 m-1 focus:ring-gray-500" value="white" title="white">
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="flex items-center justify-center lg:justify-start space-x-6 mt-14">
                        @if(empty($cart))
                            <div class="flex items-center mt-1">
                                <button
                                    class="text-gray-500 focus:outline-none focus:text-gray-600"
                                    wire:click="increment"
                                >
                                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </button>
                                <span class="text-gray-700 text-lg mx-2">{{ $counter }}</span>
                                <button
                                    wire:click="decrement"
                                    class="text-gray-500 focus:outline-none focus:text-gray-600"
                                >
                                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </button>
                            </div>
                            <button
                                wire:click="addToCart"
                                class="bg-violet-900 hover:bg-violet-500 text-gray-100 flex items-center px-3 py-2 rounded text-sm space-x-2"
                                title="Add To Cart"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span>Add to cart</span>
                            </button>
                        @elseif ($cart->id == $product->id)
                            Already in cart
                        @endif
                    </div>
                    <br>
                    @error('qty'.$product->id) <span class="bg-red-200 text-red-600 px-2 py-1 text-sm rounded">{{ $message }}</span> @enderror
                </div>
            </div>
        @endforeach
    </main>
</div>
