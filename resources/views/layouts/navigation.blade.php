<!-- ORDENADOR -->
<div class="flex antialiased flex-col w-80 text-white hidden lg:flex">
    <div class="fixed inset-y-0 z-10 flex w-80">
        <!-- CURVA MENU -->
        <svg class="absolute inset-0 w-full h-full text-customblue" style="filter: drop-shadow(20px 0 10px #00000030)" preserveAspectRatio="none" viewBox="0 0 309 800" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path  d="M268.487 0H0V800H247.32C207.957 725 207.975 492.294 268.487 367.647C329 243 314.906 53.4314 268.487 0Z"/>
        </svg>
        <div class="z-10 flex flex-col flex-1">
            <!-- NOMBRE -->
            <div class="flex items-center justify-center w-60 pl-8 pt-7">
                <span class="text-4xl"><a href="{{ route('dashboard') }}">PicPulse</a></span>
            </div>
            <!-- RUTAS -->
            <nav class="flex flex-col flex-1 w-80 mt-2 p-8  ">
                <!-- Index -->
                <a href="{{ route('dashboard') }}" id="dashboard" class="pt-2 pb-2 mr-14 rounded-lg hover:bg-blue-800 ">
                    <i class="fi-sr-home text-2xl pl-2 pr-2"></i>
                    <span class="text-xl">Inicio</span>
                </a>
                <!-- Archivos -->
                <a href="{{ route('files.index') }}" id="files" class="pt-2 pb-2 mr-8 p-2 mt-2 rounded-lg hover:bg-blue-800">
                    <i class="fi-sr-file-image text-2xl pr-2"></i>
                    <span class="text-xl">Archivos</span>
                </a>
                <!-- Publicaciones -->
                <a href="{{ route('posts.index') }}" id="posts" class="pt-2 pb-2 mr-4 p-2 mt-2 rounded-lg  hover:bg-blue-800">
                    <i class="fi-sr-images text-2xl pr-2"></i>
                    <span class="text-xl">Publicaciones</span>
                </a>
                <!-- Lugares -->
                <a href="{{ route('places.index') }}" id="places" class="pt-2 pb-2 mr-8 p-2 mt-2 rounded-lg hover:bg-blue-800">
                    <i class="fi-sr-map-marker text-2xl pr-2"></i>
                    <span class="text-xl">Lugares</span>
                </a>
                <!-- Cuenta -->
                <a href="#" id="account" class="pt-2 pb-2 mr-14 p-2 mt-2 rounded-lg hover:bg-blue-800">
                    <i class="fi-sr-circle-user text-xl pr-2"></i>
                    <span class="text-xl">Cuenta</span>
                </a>
            </nav>
            <!-- Cuenta -->
            <!------------>
            <!--  PHP   -->
            <!------------>
            <div class="flex-shrink-0 pl-4 text-xl">
                <button class="flex items-center p-3 ml-5 mb-8 space-x-2 rounded-lg px-3 py-2 text-customred cursor-pointer hover:bg-red-600 hover:text-white shadow">
                    <i class="fi-sr-exit mt-1"></i>
                    <span class="font-bold">Logout</span>
                </button>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </div>
    </div>
</div>

<!-- MOVIL / TABLET -->
<div class="w-full lg:hidden">
    <div class="fixed z-50 w-full h-16 max-w-lg -translate-x-1/2 bg-customblue rounded-full bottom-4 left-1/2">
        <div class="grid h-full max-w-lg grid-cols-5 mx-auto">
            <!-- Index -->
            <a href="{{ route('dashboard') }}" id="places" class="inline-flex flex-col items-center justify-center px-5 rounded-s-full group hover:bg-blue-800">
                <i class="text-xl text-white fi-sr-home"></i>
                <span class="text-xs text-white">Inicio</span>
            </a>
            <!-- Archivos -->
            <a href="{{ route('files.index') }}" id="files" class="inline-flex flex-col items-center justify-center px-5 group hover:bg-blue-800">
                <i class="fi-sr-file-image text-xl text-white"></i>
                <span class="text-xs text-white">Archivos</span>
            </a>
            <!-- Publicaciones -->
            <a href="{{ route('posts.index') }}" id="posts" class="inline-flex flex-col items-center justify-center px-5 group hover:bg-blue-800">
                <i class="fi-sr-images  text-xl text-white"></i>
                <span class="text-xs text-white">Publicaciones</span>
            </a>
            <!-- Lugares -->
            <a href="{{ route('places.index') }}" id="places" class="inline-flex flex-col items-center justify-center px-5 group hover:bg-blue-800">
                <i class="fi-sr-map-marker text-xl text-white"></i>
                <span class="text-xs text-white">Lugares</span>
            </a>
            <!-- Cuenta -->
            <button type="button" class="inline-flex flex-col items-center justify-center px-5 rounded-e-full group hover:bg-blue-800">
                <i class=" fi-sr-circle-user text-xl text-white"></i>
                <span class="text-xs text-white">Cuenta</span>
            </button>
        </div>
    </div>
</div>

<script>
    document.getElementById('dashboard').addEventListener('click', function () {
        document.querySelectorAll('nav a').forEach(function (el) {
            el.classList.remove('pl-10');
        });
        this.classList.add('pl-10');
        localStorage.setItem('fixedRightId', this.id);
    });

    document.getElementById('files').addEventListener('click', function () {
        document.querySelectorAll('nav a').forEach(function (el) {
            el.classList.remove('pl-10');
        });
        this.classList.add('pl-10');
        localStorage.setItem('fixedRightId', this.id);
    });

    document.getElementById('posts').addEventListener('click', function () {
        document.querySelectorAll('nav a').forEach(function (el) {
            el.classList.remove('pl-10');
        });
        this.classList.add('pl-10');
        localStorage.setItem('fixedRightId', this.id);
    });

    document.getElementById('places').addEventListener('click', function () {
        document.querySelectorAll('nav a').forEach(function (el) {
            el.classList.remove('pl-10');
        });
        this.classList.add('pl-10', 'bg-blue-800');
        localStorage.setItem('fixedRightId', this.id);
    });

    document.getElementById('account').addEventListener('click', function () {
        document.querySelectorAll('nav a').forEach(function (el) {
            el.classList.remove('pl-10');
        });
        this.classList.add('pl-10', 'bg-blue-800');
        localStorage.setItem('fixedRightId', this.id);
    });

    window.onload = function () {
        const fixedRightId = localStorage.getItem('fixedRightId');
        if (fixedRightId) {
            document.querySelectorAll('nav a').forEach(function (el) {
                el.classList.remove('pl-10');
            });
            document.getElementById(fixedRightId).classList.add('pl-10');
            document.getElementById(fixedRightId).classList.add('bg-blue-800');
        }
    };
</script>