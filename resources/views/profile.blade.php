@extends('layout')

@section('content')
<main class="bg-white border border-gray-200 rounded-lg shadow-md m-6">
    <p class="text-4xl py-2 px-4">{{ auth() -> user() -> name }}</p>
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
                    <img src="{{ $shop -> image }}" alt="Foto de la tienda" class="mx-2 w-[200px] h-[200px]">
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

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="bg-yellow-500 text-white hover:bg-yellow-600 px-4 py-2 mb-4 rounded-md" type="submit">Cerrar Sesión</button>
    </form>
</main>
@endsection
