<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Cosas -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles and scripts -->
    @env(['local','development'])
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endenv
    @env(['production'])
        @php
            $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
        @endphp
        <link rel="stylesheet" href="{{ asset('build/'.$manifest['resources/css/app.css']['file']) }}">
        <script type="module" src="{{ asset('build/'.$manifest['resources/js/app.js']['file']) }}"></script>
    @endenv
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>

    <!-- Titulo pestaña -->
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body class="bg-white h-full dark:bg-customgray">
    <div class="min-h-screen">
        @include('layouts.navigation')
        <div class="flex-1 p-4">
            <!-- PANTALLA ORDENADOR -->
            <main class="hidden lg:block ml-80">
                @if (isset($header))
                <header>
                    <div>
                        {{ $header }}
                    </div>
                </header>
                @endif
                <div class="w-full">
                    @include('partials.flash')
                    @yield('content')
                </div>
                {{ $slot }}
            </main>
            <!-- PANTALLA TABLET Y MOVIL -->
            <main class="sm:block md:block lg:hidden">
                @if (isset($header))
                <header>
                    <div class="md:max-w-7xl md:mx-auto md:py-6 md:px-4 sm:max-w-7xl sm:mx-auto sm:py-6 sm:px-6">
                        {{ $header }}
                    </div>
                </header>
                @endif
                <div class="w-full">
                    @include('partials.flash')
                    @yield('content')
                </div>
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>