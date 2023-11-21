<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ICONOS TEMPORALES / DESCARGAR PACK -->
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <script src="{{ asset('resources/js/scripts.js') }}"></script>

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

    <!-- TITULO PESTAÑA -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    
</head>

<body class="bg-white h-full dark:bg-customgray overflow-y-scroll mr-[-15px] pr-[15px]">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <div class="flex-1 p-4">
            <!-- PANTALLA GRANDE -->
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
            
            <!-- PANTALLA MEDIANA -->
            <main class="hidden md:block lg:hidden">
                @if (isset($header))
                <header>
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
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

            <!-- PANTALLA MOVIL -->
            <main class="block md:hidden">
                @if (isset($header))
                <header>
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
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
    <script>
    document.getElementById('movableDiv').addEventListener('click', function() {
        this.classList.add('translate-x-2');
    });
</script>
</body>

</html>