<!-- PANTALLA ORDENADOR -->
<div class="flex antialiased flex-col w-80 text-white hidden lg:flex">
    <div class="fixed inset-y-0 z-10 flex w-80">
        <!-- CURVA MENU -->
        <svg class="absolute inset-0 w-full h-full text-customblue" style="filter: drop-shadow(20px 0 10px #00000030)" preserveAspectRatio="none" viewBox="0 0 309 800" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M268.487 0H0V800H247.32C207.957 725 207.975 492.294 268.487 367.647C329 243 314.906 53.4314 268.487 0Z" />
        </svg>
        <div class="z-10 flex flex-col flex-1">
            <!-- NOMBRE -->
            <div class="flex items-center justify-center w-60 pl-8 pt-7">
                <span class="text-4xl"><a href="{{ route('dashboard') }}">PicPulse</a></span>
            </div>
            <!-- RUTAS -->
            <nav class="navbar flex flex-col flex-1 w-80 mt-2 p-8">
                <!-- Index -->
                <a href="{{ route('dashboard') }}" data-menu-id="dashboard" class="pt-2 pb-2 mr-14 rounded-lg hover:bg-blue-800 ">
                    <i class="fi-sr-home text-2xl pl-2 pr-2"></i>
                    <span class="text-xl">Inicio</span>
                </a>
                <!-- Archivos -->
<<<<<<< HEAD
                <a href="{{ route('files.index') }}" id="files_nav"
                    class="pt-2 pb-2 mr-8 p-2 mt-2 rounded-lg hover:bg-blue-800">
                    <i class="fi-sr-file-image text-2xl pr-2"></i>
                    <span class="text-xl">Archivos</span>
                </a>
                <!-- Publicaciones -->
                @can('viewAny', App\Models\Post::class)
                <a href="{{ route('posts.index') }}" data-menu-id="posts" class="pt-2 pb-2 mr-4 p-2 mt-2 rounded-lg  hover:bg-blue-800">
                    <i class="fi-sr-images text-2xl pr-2"></i>
                    <span class="text-xl">Publicaciones</span>
                </a>
                @endcan
                @can('viewAny', App\Models\Place::class)
                <!-- Lugares -->
                <a href="{{ route('places.index') }}" data-menu-id="places" class="pt-2 pb-2 mr-8 p-2 mt-2 rounded-lg hover:bg-blue-800">
                    <i class="fi-sr-map-marker text-2xl pr-2"></i>
                    <span class="text-xl">Lugares</span>
                </a>
                @endcan
                <!-- Cuenta -->
                <a href="{{ route('profile.update') }}" data-menu-id="account" class="pt-2 pb-2 mr-14 p-2 mt-2 rounded-lg hover:bg-blue-800">
>>>>>>> af07a3f (layout acabado)
                    <i class="fi-sr-circle-user text-xl pr-2"></i>
                    <span class="text-xl">Cuenta</span>
                </a>
            </nav>
            <!-- IDIOMA -->

        </div>
    </div>
</div>

<!-- MOVIL / TABLET -->
<div class="w-full lg:hidden">
    <div class="fixed z-50 w-full h-16 max-w-lg -translate-x-1/2 bg-customblue rounded-tl-lg rounded-tr-lg bottom-0 left-1/2">
        <nav class="navbar grid h-full max-w-lg mx-auto grid-cols-4 ">
            <!-- Index -->
            <a href="{{ route('dashboard') }}" data-menu-id="dashboard" class="inline-flex flex-col items-center justify-center px-5 rounded-tl-lg group hover:bg-blue-800">
                <i class="text-xl text-white fi-sr-home"></i>
                <span class="text-xs text-white">Inicio</span>
            </a>

            <!-- Archivos -->
            @can('viewAny', App\Models\File::class)
                <a href="{{ route('files.index') }}" data-menu-id="files" class="inline-flex flex-col items-center justify-center px-5 group hover:bg-blue-800">
                    <i class="fi-sr-file-image text-xl text-white"></i>
                    <span class="text-xs text-white">Archivos</span>
                </a>
            @endcan

            <!-- Publicaciones -->
            @can('viewAny', App\Models\Post::class)
                <a href="{{ route('posts.index') }}" data-menu-id="posts" class="inline-flex flex-col items-center justify-center px-5 group hover:bg-blue-800">
                    <i class="fi-sr-images text-xl text-white"></i>
                    <span class="text-xs text-white">Publicaciones</span>
                </a>
            @endcan

            <!-- Lugares -->
            @can('viewAny', App\Models\Place::class)
                <a href="{{ route('places.index') }}" data-menu-id="places" class="inline-flex flex-col items-center justify-center px-5 group hover:bg-blue-800">
                    <i class="fi-sr-map-marker text-xl text-white"></i>
                    <span class="text-xs text-white">Lugares</span>
                </a>
            @endcan

            <!-- Cuenta -->
            <a href="{{ route('profile.update') }}" data-menu-id="account" class="inline-flex flex-col items-center justify-center px-5 group rounded-tr-lg hover:bg-blue-800">
                <i class="fi-sr-circle-user text-xl text-white"></i>
                <span class="text-xs text-white">Cuenta</span>
            </a>
        </nav>
    </div>
</div>
