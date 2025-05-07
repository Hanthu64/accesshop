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

<main>
    <!--Título 2-->
    <div class="text-center row justify-content-center py-4">
        <h1 class="col-8">Lista de productos</h1>
    </div>
    <!--Título 2-->

    <!--PRODUCTOS-->
    @foreach($products as $product)
    <div class="mb-3 mx-12 bg-yellow-100 border border-gray-300 rounded-md">
        <div class="flex flex-wrap items-center justify-center p-4">

            <!-- Imagen -->
            <div class="w-full md:w-1/4 flex justify-center mb-4 md:mb-0">
                <img src="{{$product -> image}}" class="w-3/4" alt="{{$product -> name}}">
            </div>

            <!-- Información del producto -->
            <div class="w-full md:w-1/2 flex justify-center">
                <div class="text-center">
                    <h3 class="text-xl font-semibold">{{$product -> name}}</h3>
                    <p class="hidden md:block text-base mt-2">{{$product -> description}}</p>

                    <!-- Valoración y Comentarios (solo en md o superior) -->
                    <div class="hidden md:flex mt-4 justify-center">
                        <div>
                            <b>Comentarios:</b>
                            <p><a href="#" class="text-gray-600 hover:underline">73 comentarios</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botón para desktop -->
            <div class="hidden md:flex w-full md:w-1/4 justify-center items-center mt-4 md:mt-0">
                <form action="{{ route("show.product", $product -> id) }}">
                    <button type="submit" class="bg-yellow-500 text-white px-6 py-3 rounded-md hover:bg-yellow-600 transition">
                        Ir a la pantalla del producto
                    </button>
                </form>
            </div>

            <!-- Botón para móvil -->
            <div class="flex md:hidden w-full justify-center mt-4">
                <form action="{{ route("show.product", $product -> id) }}">
                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition">
                        Ir al producto
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</main>
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

