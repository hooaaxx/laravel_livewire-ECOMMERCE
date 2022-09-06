<x-app-layout>
    <x-slot name="header">
        <button 
            @click="activeTab = 1"
            class="w-32 py-1 rounded"
            :class="activeTab == 1 ? 'bg-violet-900 text-gray-100' : 'hover:text-primary'"
        >
            {{ __('Shirt') }}
        </button>
        <button 
            @click="activeTab = 2"
            class="w-32 py-1 rounded"
            :class="activeTab == 2 ? 'bg-violet-900 text-gray-100' : 'hover:text-primary'"
        >
            {{ __('Etc') }}
        </button>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- start::Stats -->
            <div class="container" :class="activeTab === 1 ? 'block' : 'hidden'">
                <div class="w-full xl:w-4/4 grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-2 2xl:grid-cols-2 gap-2">
                    @foreach ($productShirt as $shirt)
                    <div class="flex flex-col items-center justify-center space-y-3">
                        <a href="{{ route('products.show', $shirt->id) }}">
                            <div 
                                x-data="{ showBtn: false }"
                                class="relative overflow-hidden"
                                @mouseenter="showBtn = true"
                                @mouseleave="showBtn = false"
                            >
                                
                                @if (!empty($shirt->product_img))
                                    <img 
                                    
                                        class="w-[250px] h-[320px] transition duration-500"
                                        :class="showBtn ? 'scale-125' : ''"
                                        src="{{ url('storage/products_thumb/'. $shirt->product_img) }}" 
                                        alt="Product Name"
                                    >
                                @else
                                    No profile image available!
                                @endif
                                
                                <span class="absolute top-2 left-2 bg-green-600 text-gray-100 text-xs font-bold px-2 py-0.5 uppercase">
                                    New
                                </span>
                                <div 
                                    x-show="showBtn"
                                    x-cloak
                                    x-transition.enter.duration.500ms
                                    x-transition.leave.duration.300ms
                                    class="absolute w-full h-full top-0 left-0 z-10 bg-black bg-opacity-40 flex items-end justify-center"
                                >
                                    {{-- <div class="mb-8 space-x-3">
                                        <button class="bg-gray-100 hover:bg-primary text-primary hover:text-gray-100 p-2.5 rounded-full transition duration-200" title="Add To Wishlist">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                        </button>
                                        <button class="bg-gray-100 hover:bg-primary text-primary hover:text-gray-100 p-2.5 rounded-full transition duration-200" title="Add To Cart">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </button>
                                    </div> --}}
                                </div>
                            </div>
                        </a>
                        <div class="flex flex-col items-center justify-center space-y-1">
                            <a href="{{ route('products.show', $shirt->id) }}" class="text-gray-900 hover:text-primary">{{ $shirt->product_name }}</a>
                            
                            <span class="text-xl text-primary font-bold">&#8369;{{ $shirt->price }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                {{ $productShirt->links() }}
            </div>

            <div class="container" :class="activeTab === 2 ? 'block' : 'hidden'">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-10">
                    @foreach ($productEtc as $etc)
                    <div class="px-6 py-6 bg-white rounded-lg shadow-xl">
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-sm text-indigo-600">{{ $etc->product_name }}</span>
                            <span
                                class="text-xs bg-gray-200 hover:bg-gray-500 text-gray-500 hover:text-gray-200 px-2 py-1 rounded-lg transition duration-200 cursor-default"
                            >
                                {{ $etc->created_at->diffForHumans(); }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between mt-6">
                            <a href="{{ route('products.show', $etc->id) }}">
                                @if (!empty($etc->product_img))
                                    <img width="100px" src="{{ url('storage/products_thumb/'. $etc->product_img) }}" />
                                @else
                                    No profile image available!
                                @endif
                            </a>
                            <div class="flex flex-col">
                                <div class="flex items-end">
                                    <span class="text-2xl 2xl:text-4xl font-bold">&#8369;{{ $etc->price }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- end::Stats -->
        </div>
    </div>

    <x-slot name="footer">
    </x-slot>
</x-app-layout>
