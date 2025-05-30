@extends('layout')

@section('content')

    <!--PRODUCTOS-->
    <div class="max-w-[1400px] mx-auto bg-yellow-50 border border-gray-300 rounded-md m-3">
        <div class="text-center row justify-content-center py-4">
            <p class="text-2xl">Lista de productos</p>
        </div>
        @foreach($products as $product)
        <div class="mb-3 mx-12 bg-yellow-100 border border-gray-300 rounded-md">
            <div class="flex p-4">
                <!-- Imagen -->
                <div class="w-full md:w-1/4 flex justify-center mb-4 md:mb-0">
                    <img src="{{$product -> image}}" alt="{{$product -> name}}">
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
    </div>
@endsection
