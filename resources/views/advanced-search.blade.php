@extends('layout')

@section('content')
    <div class="max-w-[1400px] mx-auto bg-yellow-50 border border-gray-300 rounded-md m-3">
        <div class="text-center row justify-content-center py-4">
            <p class="text-2xl">Búsqueda avanzada</p>
        </div>

        <!--FORMULARIO PARA BUSCAR-->
        <form id="advancedSearch" method="GET" class="flex flex-col py-2 gap-2">
            <!--POR NOMBRE-->
            <div class="py-2 px-4">
                <p class="text-xl">Buscar por nombre</p>
                <input id="domain_name" name="domain_name" placeholder="Buscar..." class="h-12 border border-gray-300 text-base rounded-lg block w-full py-3 px-4 focus:outline-none">
            </div>

            <div class="py-2 px-4">
                <p class="text-xl">Filtrar por categoría</p>
                <input>
            </div>

            <div class="py-2 px-4">
                <p class="text-xl">Ordenar por</p>
                <select>
                    <option>Precio</option>
                    <option>Valoración</option>
                </select>
            </div>

            <div class="w-80 mx-auto mt-6">
                <label class="font-semibold block mb-2">Filtrar por precio</label>

                <!-- Sliders -->
                <div class="relative h-6">
                    <input type="range" id="minRange" name="min_price" min="0" max="5099" value="0"
                           class="absolute pointer-events-auto w-full appearance-none h-1 bg-transparent z-10">
                    <input type="range" id="maxRange" name="max_price" min="0" max="5099" value="5099"
                           class="absolute pointer-events-auto w-full appearance-none h-1 bg-transparent z-20">

                    <!-- Línea de fondo -->
                    <div class="absolute top-1/2 transform -translate-y-1/2 w-full h-1 bg-gray-300 rounded"></div>
                    <!-- Línea activa -->
                    <div id="rangeTrack" class="absolute top-1/2 transform -translate-y-1/2 h-1 bg-orange-500 rounded z-0"></div>
                </div>

                <!-- Inputs de texto -->
                <div class="flex justify-between mt-4">
                    <input type="number" id="minInput" class="border border-gray-300 rounded px-2 py-1 w-24" value="0" min="0" max="5099">€
                    <span class="mx-2">–</span>
                    <input type="number" id="maxInput" class="border border-gray-300 rounded px-2 py-1 w-24" value="5099" min="0" max="5099">€
                </div>
            </div>

            <div class="py-2 px-4">
                <p class="text-xl">Filtrar por tienda</p>
                <input>
            </div>

            <!--FILTRAR-->
            <button type="submit" class="flex items-center rounded p-3 border border-gray-200 shadow mx-2 gap-2 w-1/4">🔍
                <span>Buscar</span>
            </button>
        </form>
    </div>
    @vite('resources/js/advanced-search.js')
@endsection
