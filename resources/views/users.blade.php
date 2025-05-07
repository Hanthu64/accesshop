<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AccesShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-yellow-300">
<header>
    <!--LOS NAV-->
    <nav class="flex items-center bg-gray-100 px-4 py-2">
        <div class="flex items-center w-full justify-between mx-auto px-4">
            <form action="{{route("index")}}" class="navbar-brand col-2">
                <button>
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-[200px] h-[100px] object-contain">
                </button>
            </form>
            <form action="{{ route("index") }}" method="GET" class="hidden md:flex md:w-5/12 flex-row">
                <div class="flex w-full">
                    <input class="form-control flex-grow px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-yellow-400" type="search" name="search" placeholder="Buscar..." aria-label="Search" value="{{ request('search') }}">
                    <button class="btn px-4 py-2 border border-yellow-400 text-yellow-400 rounded-r-md hover:bg-yellow-400 hover:text-white transition"  type="submit">Buscar</button>
                </div>
            </form>
            @auth
                <form action="{{ route("profile") }}" method="GET">
                    <button class="flex items-center hidden md:flex">
                        <img src="{{ asset(auth()->user()->image) }}" alt="pfp" class="mx-2 w-[50px] h-[50px]">
                        <span>{{ auth()->user()->name }}</span>
                    </button>
                </form>
            @else
                <form action="{{ route("login") }}" method="GET">
                    <button class="hidden md:flex bg-yellow-500 text-white hover:bg-yellow-600 px-4 py-2 rounded-md" type="submit">
                        <span>Iniciar sesión</span>
                    </button>
                </form>
            @endauth

            <!--BOTÓN MÓVIL-->
            <button class="block md:hidden bg-yellow-400 p-2 rounded" onclick="document.getElementById('mobileMenu').classList.remove('hidden')">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </nav>

    <!-- MENÚ MÓVIL -->
    <div id="mobileMenu" class="fixed inset-0 bg-yellow-100 z-50 md:hidden hidden overflow-y-auto">
        <div class="flex justify-between items-center p-4 bg-yellow-400">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-[150px] h-[80px] object-contain">
            <button onclick="document.getElementById('mobileMenu').classList.add('hidden')" class="text-white text-3xl">&times;</button>
        </div>

        <div class="p-6 flex flex-col items-center text-center space-y-4">
            <!-- Cuenta -->
            <h4 class="text-lg font-semibold">Cuenta</h4>

            @auth
                <div class="flex flex-col items-center gap-1">
                    <img src="{{ asset(auth()->user()->image) }}" alt="pfp" class="mx-2 w-[50px] h-[50px]">
                    <p>{{ auth()->user()->name }}</p>
                    <form action="{{ route("profile") }}" method="GET" class="bg-yellow-400 text-white w-3/4 py-2 rounded-md">
                        <button type="submit">
                            <span>Perfil</span>
                        </button>
                    </form>
                </div>
            @else
                <form action="{{ route("login") }}" method="GET" class="bg-yellow-400 text-white w-3/4 py-2 rounded-md">
                    <button type="submit">Iniciar sesión</button>
                </form>
            @endauth

            <!-- Búsqueda -->
            <h4 class="text-lg font-semibold mt-6">Búsqueda</h4>
            <form action="{{ route("index") }}" method="GET">
                <div class="flex w-full">
                    <input class="w-full px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-yellow-500" type="search" name="search" placeholder="Buscar..." aria-label="Search" value="{{ request('search') }}">
                    <button class="bg-yellow-400 text-white px-4 rounded-r-md" type="submit">Buscar</button>
                </div>
            </form>

            <!-- Categorías -->
            <h4 class="text-lg font-semibold mt-6">Categorías</h4>
            <div class="flex flex-wrap justify-center gap-2">
                @foreach($categories as $category)
                    <form action="{{ route("index.filter", $category) }}" class="text-white">
                        <button class="bg-yellow-400 text-white px-4 py-2 rounded-md">{{$category}}</button>
                    </form>
                @endforeach

            </div>

            <!-- Más -->
            <h4 class="text-lg font-semibold mt-6">Más</h4>
            <div class="flex flex-wrap justify-center gap-2">
                <button class="bg-yellow-400 text-white px-4 py-2 rounded-md">Sobre nosotros</button>
                <button class="bg-yellow-400 text-white px-4 py-2 rounded-md">Contacto</button>
                <button class="bg-yellow-400 text-white px-4 py-2 rounded-md">Redes sociales</button>
            </div>
        </div>
    </div>

    <nav class="bg-orange-700 hidden md:flex justify-center py-3">
        <div class="mx-auto">
            <ul class="flex space-x-20">
                @foreach($categories as $category)
                    <li>
                        <form action="{{ route("index.filter", $category) }}" class="text-white">
                            <button>{{$category}}</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>
    <!--LOS NAV-->
</header>

<div class="mx-auto p-16">
    <h2 class="text-2xl font-bold mb-4 text-center">Usuarios</h2>

    <table class="min-w-full border border-gray-200 shadow-md mb-3 bg-yellow-100 rounded-md">
        <thead>
        <tr>
            <th class="py-2 px-4 text-left">ID</th>
            <th class="py-2 px-4 text-left">Nombre</th>
            <th class="py-2 px-4 text-left">Email</th>
        </tr>
        </thead>
        <tbody id="data-container" >
        @foreach($users as $user)
            <tr class="border-b hover:bg-gray-100">
                <td class="py-2 px-4">{{$user -> id}}</td>
                <td class="py-2 px-4">{{$user -> name}}</td>
                <td class="py-2 px-4">{{$user -> email}}</td>

                <td class="py-2 px-4 flex justify-end">
                    <form action="{{ route("users.list") }}" method="GET">
                        <button type="submit" class="p-2 hover:bg-blue-200 rounded-full focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>
                    </form>
                    <button type="submit" class="user-editor p-2 hover:bg-blue-200 rounded-full focus:outline-none" data-userid="{{ $user->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </button>

                    <!---->
                    <button type="button" class="user-deleter p-2 hover:bg-blue-200 rounded-full focus:outline-none" data-userid="{{ $user->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- BORRAR -->

    <div id="edit_modal_holder" class="hidden relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="hidden inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="mx-auto p-8">
                        <div class="flex justify-between items-center pb-3 mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Usuarios</h3>
                            <button id="edit_cancel_icon" class="text-gray-400 hover:text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div id="insertFormModal"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="mt-5 text-light">
    <!-- Parte visible solo en móviles (d-md-none) -->
    <div class="py-4 bg-yellow-500 md:hidden">
        <div class="flex justify-center">
            <div class="w-1/3">
                <img src="{{ asset('images/logo.png') }}" class="img-fluid" alt="Imagen">
            </div>
        </div>
    </div>

    <!-- Parte visible solo en pantallas medianas y mayores (d-none d-md-flex) -->
    <div class="py-4 bg-yellow-500 hidden md:flex text-center">
        <div class="w-1/3">
            <h5 class="text-lg font-semibold">Sobre nosotros</h5>
            <ul class="list-none space-y-2">
                <li><a href="#" class="text-decoration-none text-light">Quiénes somos</a></li>
                <li><a href="#" class="text-decoration-none text-light">Proveedores</a></li>
                <li><a href="#" class="text-decoration-none text-light">FAQ</a></li>
                <li><a href="#" class="text-decoration-none text-light">Aviso legal</a></li>
                <li><a href="#" class="text-decoration-none text-light">Privacidad</a></li>
            </ul>
        </div>
        <div class="w-1/3">
            <h5 class="text-lg font-semibold">Contactar</h5>
            <ul class="list-none space-y-2">
                <li><a href="#" class="text-decoration-none text-light">Privacidad</a></li>
                <li><a href="#" class="text-decoration-none text-light">Contacto</a></li>
                <li><a href="#" class="text-decoration-none text-light">Acuerdo de promoción</a></li>
                <li><a href="#" class="text-decoration-none text-light">Política de Cookies</a></li>
            </ul>
        </div>
        <div class="w-1/3">
            <h5 class="text-lg font-semibold">Redes Sociales</h5>
            <ul class="list-none space-y-2">
                <li><a href="#" class="text-decoration-none text-light">Facebook</a></li>
                <li><a href="#" class="text-decoration-none text-light">Twitter</a></li>
                <li><a href="#" class="text-decoration-none text-light">Instagram</a></li>
                <li><a href="#" class="text-decoration-none text-light">YouTube</a></li>
                <li><a href="#" class="text-decoration-none text-light">TikTok</a></li>
            </ul>
        </div>
    </div>

    <div class="bg-orange-700 text-white text-center py-2">
        <p>©AccesShop 2023-2023. Todos los derechos reservados.</p>
    </div>
</footer>
</body>
</html>
