@extends('layout')

@section('content')

    <!--PRODUCTOS-->
    <div class="max-w-[1400px] mx-auto bg-yellow-50 border border-gray-300 rounded-md m-3 p-2">
        <form id="advancedSearch1" method="GET" action="{{ route("index") }}" class="flex flex-col py-2 gap-2 mb-3 mx-12">
            <p class="text-2xl self-center">Productos con tiendas</p>
            <div class="flex flex-col">
                <div class="flex justify-evenly">
                    <div class="py-2 px-4 w-1/3">
                        <p class="text-xl">Buscar por nombre</p>
                        <input type="search" name="search" placeholder="Buscar..." class="h-12 border border-gray-300 text-base rounded-lg block w-full py-3 px-4 focus:outline-none">
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

                    <div class="py-2 px-4">
                        <p class="text-xl">Ordenar previsualización de tiendas</p>
                        <select name="shopPreviewSorter" id="shopPreviewSorter" class="h-12 border border-gray-300 text-base rounded-lg block w-full py-3 px-4 focus:outline-none">
                            <option value="1">Precio</option>
                            <option value="2">Valoración</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-evenly pt-4">
                    <button type="submit" class="rounded p-3 border border-gray-200 shadow mx-2 gap-2 w-1/4">🔍
                        <span>Buscar</span>
                    </button>
                    <button type="button" class="rounded p-3 border border-gray-200 shadow mx-2 gap-2 w-1/4" onclick="window.location.href='{{ route("individual-search") }}'" >
                        <span>Buscar por producto individual</span> 👉
                    </button>
                </div>
            </div>
        </form>

        @foreach($products as $product)
        <div class="mb-3 mx-12 bg-yellow-100 border border-gray-300 rounded-md">
            <div class="flex p-4">
                <!-- Imagen -->
                <div class="w-full md:w-1/4 flex justify-center mb-4 md:mb-0">
                    <img src="{{$product -> image}}" alt="{{$product -> name}}" class="border rounded-md bg-white p-4">
                </div>

                <!-- Título y botón para ir a página del producto -->
                <div class="w-full md:w-1/4">
                    <div class="flex flex-col gap-3 p-3">
                        <p class="text-xl font-semibold">{{$product -> name}}</p>
                        <form action="{{ route("show.product", $product -> id) }}">
                            <button type="submit" class="bg-yellow-500 text-white px-6 py-3 rounded-md hover:bg-yellow-600 transition">
                                Ir al producto
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Tabla para desktop -->
                <div class="hidden md:block w-full md:w-1/2 mt-4 md:mt-0">
                    <table class="min-w-full mb-3 rounded-md">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 text-left">TIENDA</th>
                                <th class="py-2 px-4 text-left">VALORACIÓN</th>
                                <th class="py-2 px-4 text-left">PRECIO</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($product -> shop -> take(3) -> pad(3, null) as $shop)
                            <tr class="border-b  {{ $loop -> odd ? 'bg-gray-200' : '' }}">
                                <td class="py-2 px-4">{{ $shop ? $shop -> name : 'N/A'}}</td>
                                <td class="py-2 px-4 flex">
                                    @if($shop)
                                        @for($i = 1; $i <= $shop -> pivot -> rating; $i++)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.975a1 1 0 00.95.69h4.184c.969 0 1.371 1.24.588 1.81l-3.39 2.463a1 1 0 00-.364 1.118l1.286 3.975c.3.921-.755 1.688-1.54 1.118l-3.39-2.463a1 1 0 00-1.175 0l-3.39 2.463c-.784.57-1.838-.197-1.539-1.118l1.286-3.975a1 1 0 00-.364-1.118L2.04 9.402c-.783-.57-.38-1.81.588-1.81h4.184a1 1 0 00.95-.69l1.287-3.975z" />
                                            </svg>
                                        @endfor
                                    @endif
                                </td>
                                <td class="py-2 px-2">{{ $shop ? $shop -> pivot -> price : '0'}}€</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
        <div class="pagination">
            {{ $products->links() }}
        </div>
    </div>
@endsection
