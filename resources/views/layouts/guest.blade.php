<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Cosas -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fuentes y estilos -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap">
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.0.0/uicons-solid-rounded/css/uicons-solid-rounded.css">
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.0.0/uicons-regular-rounded/css/uicons-regular-rounded.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Titulo pestaña -->
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="relative min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <!-- Video de fondo -->
        <video autoplay loop muted class="absolute inset-0 w-full h-full object-cover z-0 hidden md:block">
            <source src="{{ asset('storage/fondo.mp4') }}" type="video/mp4">
        </video>
        <!-- Contenido web -->
        <div class="w-full sm:max-w-md mt-6 px-6 py-4">
            {{ $slot }}
        </div>
    </div>
</body>

</html>