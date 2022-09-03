<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
{{-- ronaldo --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- carousel --}}
            <div class="sliderAx h-auto">
                <div id="slider-1" class="container">
                    <div class="bg-cover bg-center  h-auto text-white py-24 px-10 object-fill" style="background-image: url({{ url('images/background1.jpg') }})">
                        
                        <div class="md:w-1/2">
                            <p class="font-bold text-sm uppercase">Products</p>
                            <p class="text-3xl font-bold">Shirt</p>
                            <p class="text-2xl mb-10 leading-none">available Products</p>
                            <a href="{{ route('products.index') }}" class="bg-purple-800 py-4 px-8 text-white font-bold uppercase text-xs rounded hover:bg-gray-200 hover:text-gray-800">Here</a>
                        </div>  
                    </div> <!-- container -->
                    <br>
                </div>
          
                <div id="slider-2" class="container mx-auto">
                    <div class="bg-cover bg-center  h-auto text-white py-24 px-10 object-fill" style="background-image: url({{ url('images/jokerblack.jpg') }})">
                 
                        <p class="font-bold text-sm uppercase">Sample</p>
                        <p class="text-3xl font-bold">Best Seller</p>
                        <p class="text-2xl mb-10 leading-none">Joker</p>
                        <a href="{{ url('products/1') }}" class="bg-purple-800 py-4 px-8 text-white font-bold uppercase text-xs rounded hover:bg-gray-200 hover:text-gray-800">Here</a>
                   
                    </div> <!-- container -->
                    <br>
                </div>
            </div>
            <div  class="flex justify-between w-12 mx-auto pb-2">
                  <button id="sButton1" onclick="sliderButton1()" class="bg-purple-400 rounded-full w-4 pb-2 " ></button>
              <button id="sButton2" onclick="sliderButton2() " class="bg-purple-400 rounded-full w-4 p-2"></button>
            </div>

            {{-- Products --}}
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
        </div>
    </div>

    <x-slot name="footer">
        <div class="text-center p-6 bg-green-900">
            <div class="flex justify-center items-center lg:justify-between p-6 border-b border-gray-300">
                <div class="mr-12 hidden lg:block">
                    <span>Get connected with us on social networks:</span>
                </div>
                <div class="flex justify-center">
                    <a href="https://www.facebook.com/klightclothing" class="mr-6 text-black">
                        <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-f"
                        class="w-2.5" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 320 512">
                        <path fill="currentColor"
                            d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z">
                        </path>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="mx-6 py-10 text-center md:text-left">
                <div class="grid grid-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="">
                        <h6 class="
                            uppercase
                            font-semibold
                            mb-4
                            flex
                            items-center
                            justify-center
                            md:justify-start
                        ">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cubes"
                            class="w-4 mr-3" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512">
                            <path fill="currentColor"
                            d="M488.6 250.2L392 214V105.5c0-15-9.3-28.4-23.4-33.7l-100-37.5c-8.1-3.1-17.1-3.1-25.3 0l-100 37.5c-14.1 5.3-23.4 18.7-23.4 33.7V214l-96.6 36.2C9.3 255.5 0 268.9 0 283.9V394c0 13.6 7.7 26.1 19.9 32.2l100 50c10.1 5.1 22.1 5.1 32.2 0l103.9-52 103.9 52c10.1 5.1 22.1 5.1 32.2 0l100-50c12.2-6.1 19.9-18.6 19.9-32.2V283.9c0-15-9.3-28.4-23.4-33.7zM358 214.8l-85 31.9v-68.2l85-37v73.3zM154 104.1l102-38.2 102 38.2v.6l-102 41.4-102-41.4v-.6zm84 291.1l-85 42.5v-79.1l85-38.8v75.4zm0-112l-102 41.4-102-41.4v-.6l102-38.2 102 38.2v.6zm240 112l-85 42.5v-79.1l85-38.8v75.4zm0-112l-102 41.4-102-41.4v-.6l102-38.2 102 38.2v.6z">
                            </path>
                        </svg>
                        About Klight Apparel & Clothing
                        </h6>
                        <p>
                        Here you can use rows and columns to organize your footer content. Lorem ipsum dolor
                        sit amet, consectetur adipisicing elit.
                        </p>
                    </div>
                    <div class="">
                        <h6 class="uppercase font-semibold mb-4 flex justify-center md:justify-start">
                        Products
                        </h6>
                        <p class="mb-4">
                            <a href="{{ route('products.index') }}" class="text-black">Shirt</a>
                        </p>
                        <p>
                            <a href="{{ route('products.index') }}" class="text-black">Etc</a>
                        </p>
                    </div>
                    <div class="">
                        <h6 class="uppercase font-semibold mb-4 flex justify-center md:justify-start">
                        Useful links
                        </h6>
                        <p class="mb-4">
                        <a href="{{ route('profile') }}" class="text-black">Settings</a>
                        </p>
                        <p class="mb-4">
                        <a href="{{ route('profile') }}" class="text-black">Orders</a>
                        </p>
                        <p>
                        <a href="#!" class="text-black">Help</a>
                        </p>
                    </div>
                    <div class="">
                        <h6 class="uppercase font-semibold mb-4 flex justify-center md:justify-start">
                        Contact
                        </h6>
                        <p class="flex items-center justify-center md:justify-start mb-4">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="home"
                            class="w-4 mr-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path fill="currentColor"
                            d="M280.37 148.26L96 300.11V464a16 16 0 0 0 16 16l112.06-.29a16 16 0 0 0 15.92-16V368a16 16 0 0 1 16-16h64a16 16 0 0 1 16 16v95.64a16 16 0 0 0 16 16.05L464 480a16 16 0 0 0 16-16V300L295.67 148.26a12.19 12.19 0 0 0-15.3 0zM571.6 251.47L488 182.56V44.05a12 12 0 0 0-12-12h-56a12 12 0 0 0-12 12v72.61L318.47 43a48 48 0 0 0-61 0L4.34 251.47a12 12 0 0 0-1.6 16.9l25.5 31A12 12 0 0 0 45.15 301l235.22-193.74a12.19 12.19 0 0 1 15.3 0L530.9 301a12 12 0 0 0 16.9-1.6l25.5-31a12 12 0 0 0-1.7-16.93z">
                            </path>
                        </svg>
                        1 Falcon, Novaliches, Quezon City, Metro Manila
                        </p>
                        <p class="flex items-center justify-center md:justify-start mb-4">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="envelope"
                            class="w-4 mr-4" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512">
                            <path fill="currentColor"
                            d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z">
                            </path>
                        </svg>
                        klight@gmail.com
                        </p>
                        <p class="flex items-center justify-center md:justify-start mb-4">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="phone"
                            class="w-4 mr-4" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512">
                            <path fill="currentColor"
                            d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z">
                            </path>
                        </svg>
                        +639123456789
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    @section('carousel')
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script>
        var cont=0;
        function loopSlider(){
        var xx= setInterval(function(){
            switch(cont)
            {
            case 0:{
                $("#slider-1").fadeOut(400);
                $("#slider-2").delay(400).fadeIn(400);
                $("#sButton1").removeClass("bg-purple-800");
                $("#sButton2").addClass("bg-purple-800");
            cont=1;
            
            break;
            }
            case 1:
            {
            
                $("#slider-2").fadeOut(400);
                $("#slider-1").delay(400).fadeIn(400);
                $("#sButton2").removeClass("bg-purple-800");
                $("#sButton1").addClass("bg-purple-800");
            
            cont=0;
            
            break;
            }
            
            
            }},8000);
        }

        function reinitLoop(time){
            clearInterval(xx);
            setTimeout(loopSlider(),time);
        }



        function sliderButton1(){

        $("#slider-2").fadeOut(400);
        $("#slider-1").delay(400).fadeIn(400);
        $("#sButton2").removeClass("bg-purple-800");
        $("#sButton1").addClass("bg-purple-800");
        reinitLoop(4000);
        cont=0
        
        }
        
        function sliderButton2(){
        $("#slider-1").fadeOut(400);
        $("#slider-2").delay(400).fadeIn(400);
        $("#sButton1").removeClass("bg-purple-800");
        $("#sButton2").addClass("bg-purple-800");
        reinitLoop(4000);
        cont=1
        
        }

        $(window).ready(function(){
            $("#slider-2").hide();
            $("#sButton1").addClass("bg-purple-800");
            

            loopSlider();
        });

    
    </script>
    @endsection
</x-app-layout>
