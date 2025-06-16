@extends('layout')

@section('content')
<main class="bg-yellow-50 border border-gray-200 rounded-lg shadow-md m-6 flex flex-col items-center max-w-[1400px] mx-auto">
    <p class="text-4xl py-2 px-4 my-6">{{ auth() -> user() -> name }}</p>
    <div class="w-full flex flex-col md:flex-row gap-6 justify-evenly mb-6">
        <div class="flex flex-col items-center gap-4">
            <img src="{{ auth() -> user() ->image }}" alt="Sin foto" class="w-[300px] h-[300px]">
            <button class="hidden md:flex bg-yellow-500 text-white hover:bg-yellow-600 px-4 py-2 rounded-md"
                    type="submit">
                <span>Cambiar foto de perfil</span>
            </button>
            <button class="md:hidden bg-yellow-500 text-white hover:bg-yellow-600 px-4 py-2 rounded-md" type="submit">
                <span>Cambiar foto</span>
            </button>
        </div>
        @auth
            @if(auth()->user()->role === 'provider')
                <div class="flex flex-col items-center gap-4">
                    <p class="text-2xl">Cuenta de proveedor</p>
                    <div class="flex flex-col items-center mb-4 bg-white w-[200px] h-[200px] justify-center border border-gray-300 rounded-md">
                        <img src="{{ $shop -> image }}" alt="Foto de la tienda">
                    </div>
                    <p class="text-xl">{{ $shop -> name }}</p>
                </div>
            @endif
        @endauth
    </div>

    @auth
        @if(auth()->user()->role === 'provider')
            @include("provider-view")
        @endif
        @if(auth()->user()->role === 'admin')
            @include("admin-view")
        @endif
    @endauth
</main>
@endsection
