@extends('layout')

@section('content')
    <div class="max-w-[1400px] mx-auto bg-yellow-50 border border-gray-300 rounded-md m-3 py-6">
        <form id="individualSearch" method="GET" class="flex flex-col py-2 gap-2">
            <p class="text-2xl self-center">Productos individuales</p>
            <div class="flex flex-col">
                <div class="flex justify-evenly">
                    <div class="py-2 px-4 w-1/3">
                        <p class="text-xl">Buscar por nombre de producto</p>
                        <input type="search" name="searchProdName" placeholder="Buscar..." class="h-12 border border-gray-300 text-base rounded-lg block w-full py-3 px-4 focus:outline-none">
                    </div>

                    <div class="py-2 px-4">
                        <p class="text-xl">Filtrar por categoría</p>
                        <select name="category" id="category" class="h-12 border border-gray-300 text-base rounded-lg block w-full py-3 px-4 focus:outline-none">
                            <option value="">Seleccione una categoría</option>
                            @foreach($categories as $category)
                                <option value="{{ $category -> id }}">{{ $category -> name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex justify-evenly">
                    <div class="py-2 px-4">
                        <p class="text-xl">Filtrar por tienda</p>
                        <select name="shop" id="shop" class="h-12 border border-gray-300 text-base rounded-lg block w-full py-3 px-4 focus:outline-none">
                            <option value=" ">Todas las tiendas</option>
                            @foreach($shops as $shop)
                                <option value="{{ $shop -> id }}">{{ $shop -> name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="py-2 px-4">
                        <p class="text-xl">Ordenar por</p>
                        <select name="sorter" id="sorter" class="h-12 border border-gray-300 text-base rounded-lg block w-full py-3 px-4 focus:outline-none">
                            <option value="1">Precio</option>
                            <option value="2">Valoración</option>
                        </select>
                    </div>

                    <div>
                        <p class="text-xl">Filtrar por precio</p>
                        <div class="flex justify-between mt-4">
                            <input type="number" name="price_min" id="minInput" class="border border-gray-300 rounded px-1 py-1 w-24"
                                   value="0" min="0" max="9999">
                            <span class="mx-2">–</span>
                            <input type="number" name="price_max"
                                   id="maxInput" class="border border-gray-300 rounded px-1 py-1 w-24"
                                   value="9999" min="0" max="9999">
                        </div>
                    </div>
                </div>
                <div class="flex justify-evenly pt-4">
                    <button type="button" class="rounded p-3 border border-gray-200 shadow mx-2 gap-2 w-1/4" onclick="window.location.href='{{ route("index") }}'" >👈
                        <span>Buscar por productos con tiendas</span>
                    </button>
                    <button type="submit"
                            class=" rounded p-3 border border-gray-200 shadow mx-2 gap-2 w-1/4">🔍
                        <span>Buscar</span>
                    </button>
                </div>
            </div>
        </form>

        <div class="flex flex-wrap justify-evenly m-2 mt-4 gap-2">
            @foreach($products as $product)
                <div class="basis-1/5 flex bg-yellow-100 border border-gray-300 rounded-md">
                    <div class="flex flex-col items-center justify-center p-4">
                        <!-- Imagen -->
                        <div class="flex flex-col items-center gap-2 mb-4 md:mb-0">
                            <img src="{{$product -> product_image}}" class="w-3/4  border rounded-md bg-white p-4" alt="{{$product -> product_name}}">
                            <p class="text-xl font-bold">{{$product -> product_name}}</p>
                        </div>

                        <!-- Información del producto -->
                        <div class="md:w-1/2 flex flex-col items-center">
                            <div class="flex flex-col gap-1 items-center">
                                <div>
                                    <b>Valoración:</b>
                                    <p class="flex text-yellow-400">
                                        @for($i = 1; $i <= $product -> rating; $i++)
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"
                                                 fill="currentColor">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.975a1 1 0 00.95.69h4.184c.969 0 1.371 1.24.588 1.81l-3.39 2.463a1 1 0 00-.364 1.118l1.286 3.975c.3.921-.755 1.688-1.54 1.118l-3.39-2.463a1 1 0 00-1.175 0l-3.39 2.463c-.784.57-1.838-.197-1.539-1.118l1.286-3.975a1 1 0 00-.364-1.118L2.04 9.402c-.783-.57-.38-1.81.588-1.81h4.184a1 1 0 00.95-.69l1.287-3.975z"/>
                                            </svg>
                                        @endfor
                                    </p>
                                </div>
                                <div>
                                    <b>Precio:</b>
                                    <p>{{$product -> price}}€</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col items-center gap-2 py-2">
                            <p>Pertenece a</p>
                            <img src="{{$product -> shop_image}}" class="w-3/4" alt="{{$product -> shop_name}}">
                            <p class="font-bold">{{ $product -> shop_name }}</p>
                        </div>
                        <!-- Botón para desktop -->
                        <div class="hidden md:flex md:flex-col w-full md:w-1/4 justify-center items-center mt-4 md:mt-0 gap-2">
                            <a href="{{$product -> product_link}}"
                               class="bg-yellow-500 text-white px-6 py-3 rounded-md hover:bg-yellow-600 transition">
                                Página
                            </a>
                            <form action="{{ route("show.product", $product -> id) }}">
                                <button type="submit" class="bg-yellow-500 text-white px-6 py-3 rounded-md hover:bg-yellow-600 transition">
                                    Comparar
                                </button>
                            </form>
                        </div>

                        <!-- Botón para móvil -->
                        <div class="flex md:hidden w-full justify-center mt-4">
                            <button type="button"
                                    class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition">
                                Página
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @vite('resources/js/individual-search.js')
@endsection
