<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white">
            {{ __('Places') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 h-full">
            <!-- BUSCADOR -->
            <form class="flex items-center my-8" action="{{ route('places.search') }}" method="GET">
                <div class="relative w-full">
                    <input type="text" id="search" name="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-5 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar..." required>
                </div>
                <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </button>
            </form>
            <!-- CREAR LUGAR -->
            <a href="{{ route('places.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md mb-4 inline-block">Añadir Lugar</a>
            <!-- LUGARES -->
            <div class="flex flex-col h-screen">
                @foreach ($places as $place)
                <div class="relative flex flex-col md:flex-row mb-5 md:space-x-5 space-y-3 md:space-y-0 rounded-xl shadow-lg p-3 max-w-xs md:max-w-3xl mx-auto border border-white bg-white dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <!-- IMAGEN -->
                    <div class="w-full md:w-1/3 grid place-items-center">
                        <img src="{{ asset('storage/' . $place->file->filepath) }}" alt="tailwind logo" class="rounded-xl" />
                    </div>
                    <div class="w-full md:w-2/3 flex flex-col space-y-2 p-3">
                        <div class="flex justify-between item-center">
                            <!-- TITULO -->
                            <div class="flex items-center">
                                <a href="{{ route('places.show', $place->id) }}">
                                    <h3 class="font-black text-gray-800 md:text-3xl text-xl dark:text-white">{{ $place->title }}</h3>
                                </a>
                            </div>
                            <!-- FAVORITOS -->
                            <div class="flex items-center">
                                @if(auth()->check() && auth()->user()->favorites->contains($place->id))
                                    <form action="{{ route('places.unfavorites', ['place' => $place->id]) }}" method="POST" class="flex items-center">
                                        @csrf
                                        @method('DELETE')
                                        <button class="ml-8 pt-2"><i class="fi-sr-star ml-3 text-yellow-500 text-2xl"></i></button>
                                    </form>
                                @else
                                    <form action="{{ route('places.favorites', ['place' => $place->id]) }}" method="POST" class="flex items-center">
                                        @csrf
                                        <button class="ml-8 pt-2"><i class="fi-sr-star ml-3 text-2xl"></i></button>
                                    </form>
                                @endif
                                <p class="pt-1 text-gray-600 font-bold text-sm ml-2 dark:text-white">{{ $place->favorited()->count() }} Favoritos</p>
                            </div>
                        </div>
                        <!-- DESCRIPCION -->
                        <p class="text-gray-500 dark:text-white">{{ $place->descripcion }}</p>
                    </div>
                </div>
                @endforeach
                {{ $places->links() }}
            </div>
        </div>
    </div>

</x-app-layout>
