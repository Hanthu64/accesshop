<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-yellow-300">
        <div class="min-h-screen flex sm:justify-center items-center pt-6 sm:pt-0">
            <div class="w-full max-w-lg bg-yellow-50 border-gray-300 rounded-md flex flex-col justify-center items-center p-8 sm:rounded-lg">
                <div>
                    <a href="/">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-[200px] h-[100px] object-contain">
                    </a>
                </div>

                <div class="w-full border mt-6 px-6 py-6 bg-yellow-200 overflow-hidden sm:rounded-lg">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
