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
                <a href="{{ route('dashboard') }}" data-menu-id="dashboard" class="link pt-2 pb-2 mr-14 rounded-lg hover:bg-blue-800 ">
                    <i class="fi-sr-home text-2xl pl-2 pr-2"></i>
                    <span class="text-xl">{{ __('Inicio') }}</span>
                </a>

                <!-- Archivos -->
                @can('viewAny', App\Models\File::class)
                <a href="{{ route('files.index') }}" data-menu-id="files" class="link pt-2 pb-2 mr-8 p-2 mt-2 rounded-lg hover:bg-blue-800">
                    <i class="fi-sr-file-image text-2xl pr-2"></i>
                    <span class="text-xl">{{ __('Files') }}</span>
                </a>
                @endcan

                <!-- Publicaciones -->
                @can('viewAny', App\Models\Post::class)
                <a href="{{ route('posts.index') }}" data-menu-id="posts" class="link pt-2 pb-2 mr-4 p-2 mt-2 rounded-lg  hover:bg-blue-800">
                    <i class="fi-sr-images text-2xl pr-2"></i>
                    <span class="text-xl">{{ __('Posts') }}</span>
                </a>
                @endcan

                <!-- Lugares -->
                @can('viewAny', App\Models\Place::class)
                <a href="{{ route('places.index') }}" data-menu-id="places" class="link pt-2 pb-2 mr-8 p-2 mt-2 rounded-lg hover:bg-blue-800">
                    <i class="fi-sr-map-marker text-2xl pr-2"></i>
                    <span class="text-xl">{{ __('Places') }}</span>
                </a>
                @endcan

                <!-- Administracion -->
                @can('viewAny', App\Models\File::class)
                <a href="{{ url('admin') }}" class="pt-2 pb-2 mr-14 p-2 mt-2 rounded-lg hover:bg-blue-800">
                    <i class="fi-sr-user-crown text-xl pr-2"></i>
                    <span class="text-xl">{{ __('Administración') }}</span>
                </a>
                @endcan

                <!-- Cuenta -->
                <a href="{{ route('profile.update') }}" data-menu-id="account" class="link pt-2 pb-2 mr-14 p-2 mt-2 rounded-lg hover:bg-blue-800">
                    <i class="fi-sr-circle-user text-xl pr-2"></i>
                    <span class="text-xl">{{ __('Cuenta') }}</span>
                </a>

                <!-- SOBRE NOSOTROS -->
                <a href="{{ route('about') }}" data-menu-id="about" class="link pt-2 pb-2 mr-14 p-2 mt-2 rounded-lg hover:bg-blue-800">
                    <i class="fi-sr-users-alt text-xl pr-2"></i>
                    <span class="text-xl text-white">{{ __('About') }}</span>
                </a>
 
            </nav>
            <!-- IDIOMA -->
            <div class="bottom-0">
                <x-language-switcher />
            </div>
        </div>
    </div>
</div>

<!-- MOVIL / TABLET -->
<div class="lg:hidden">
    <div class="fixed inset-x-0 w-full bottom-0 h-16 max-w-lg -translate-x-1/2 bg-customblue rounded-tl-lg rounded-tr-lg left-1/2">
        <nav class="navbar flex max-w-lg mx-auto">
            <!-- Index -->
            <a href="{{ route('dashboard') }}" data-menu-id="dashboard" class="link flex-1 justify-center grid place-items-center py-3 rounded-tl-lg hover:bg-blue-800">
                <i class="fi-sr-home text-xl text-white  mb-1"></i>
                <span class="text-xs text-white">{{ __('Inicio') }}</span>
            </a>

            <!-- Archivos -->
            @can('viewAny', App\Models\File::class)
            <a href="{{ route('files.index') }}" data-menu-id="files" class="link flex-1 justify-center grid place-items-center py-3 hover:bg-blue-800">
                <i class="fi-sr-file-image text-xl text-white mb-1"></i>
                <span class="text-xs text-white">{{ __('Files') }}</span>
            </a>
            @endcan

            <!-- Publicaciones -->
            @can('viewAny', App\Models\Post::class)
            <a href="{{ route('posts.index') }}" data-menu-id="posts" class="link flex-1 justify-center grid place-items-center py-3 hover:bg-blue-800">
                <i class="fi-sr-images text-xl text-white mb-1"></i>
                <span class="text-xs text-white">{{ __('Posts') }}</span>
            </a>
            @endcan

            <!-- Lugares -->
            @can('viewAny', App\Models\Place::class)
            <a href="{{ route('places.index') }}" data-menu-id="places" class="link flex-1 justify-center grid place-items-center py-3 hover:bg-blue-800">
                <i class="fi-sr-map-marker text-xl text-white mb-1"></i>
                <span class="text-xs text-white">{{ __('Places') }}</span>
            </a>
            @endcan

            <!-- Administracion -->
            @can('viewAny', App\Models\File::class)
                <a href="{{ url('admin') }}" class="flex-1 justify-center grid place-items-center py-3 hover:bg-blue-800">
                    <i class="fi-sr-user-crown text-xl text-white mb-1"></i>
                    <span class="text-xs text-white">{{ __('Administración') }}</span>
                </a>
            @endcan

            <!-- Cuenta -->
            <a href="{{ route('profile.update') }}" data-menu-id="account" class="link flex-1 justify-center grid place-items-center py-3 rounded-tr-lg hover:bg-blue-800">
                <i class="fi-sr-circle-user text-xl text-white mb-1"></i>
                <span class="text-xs text-white">{{ __('Cuenta') }}</span>
            </a>

            <!-- SOBRE NOSOTROS -->
            <a href="{{ route('about') }}" data-menu-id="about" class="link flex-1 justify-center grid place-items-center py-3 rounded-tl-lg hover:bg-blue-800">
                <i class="fi-sr-users-alt text-xl text-white  mb-1"></i>
                <span class="text-xs text-white">{{ __('About') }}</span>
            </a>
        </nav>
    </div>
</div>

<script>
    // MENU PC / TABLET / MOVIL
    let colorSeleccionado = null;

    function aplicarEstilos(id) {
        document.querySelectorAll('.navbar .link').forEach(function(el) {
            el.classList.remove('pl-10');
            el.classList.remove('bg-blue-800');
        });

        let primerMenu = document.querySelector('.navbar .link');

        if (primerMenu) {
            primerMenu.classList.remove('pl-10');
        }
        
        document.querySelectorAll('.navbar .link[data-menu-id="' + id + '"]').forEach(function(el, index) {
            if (index === 0) {
                el.classList.add('pl-10');
            }
            el.classList.add('bg-blue-800');
        });
    }

    document.querySelectorAll('.navbar .link').forEach(function(link) {
        link.addEventListener('click', function() {
            colorSeleccionado = this.dataset.menuId;
            aplicarEstilos(colorSeleccionado);
            guardarColorEnLocalStorage(colorSeleccionado);
        });
    });

    window.onload = function() {
        colorSeleccionado = localStorage.getItem('ColorDerecha');
        if (colorSeleccionado) {
            document.querySelectorAll('.navbar .link').forEach(function(el) {
                el.classList.remove('pl-10');
                el.classList.remove('bg-blue-800');
            });
            document.querySelectorAll('.navbar .link[data-menu-id="' + colorSeleccionado + '"]').forEach(function(el, index) {
                if (index === 0) {
                    el.classList.add('pl-10');
                }
                el.classList.add('bg-blue-800');
            });
        }
    };

    function guardarColorEnLocalStorage(color) {
        localStorage.setItem('ColorDerecha', color);
    }

</script>