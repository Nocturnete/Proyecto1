<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-black text-5xl md:text-4xl lg:text-4xl lg:mt-3 dark:text-white">
            {{ __('Lugares') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="w-full mx-auto h-full ">
            <!-- BUSCADOR -->
            <div class="lg:flex lg:justify-center">
                <form class="flex items-center mb-8" action="{{ route('places.search') }}" method="GET">
                    <div class="relative w-full lg:w-80">
                        <input type="search" name="search" placeholder="Buscar" class="bg-gray-200 h-10 px-5 pr-10 rounded-full text-sm focus:outline-none w-full">
                        <button type="submit" class="absolute inset-y-0 right-0 px-3 py-2">
                            <i class="fi-rr-search dark:text-black"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- CREAR LUGAR -->
            <div class="lg:m-6 flex items-center justify-center">
                <a href="{{ route('places.create') }}">
                    <i class="fi-sr-add text-customblue text-4xl"></i>
                </a>
            </div>

            <!-- LUGARES -->
            <div class="w-full mx-auto h-full border-3 border-red-500">
                <div class="w-full mx-auto h-full flex flex-col">
                    @foreach ($places as $place)
                    <a href="{{ route('places.show', $place->id) }}">
                        <div class="relative flex flex-col mb-3 mt-3 bg-gray-200 space-y-3 rounded-2xl shadow-lg p-3 w-full mx-auto h-full lg:transform lg:transition lg:duration-500 lg:hover:scale-105 lg:hover:shadow-2xl lg:max-w-6xl lg:w-full md:space-y-3 md:space-x-0 md:flex-row dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <!-- IMAGEN -->
                            <div class="w-full md:w-1/3 grid place-items-center">
                                <img src="{{ asset('storage/' . $place->file->filepath) }}" class="rounded-xl w-full" />
                            </div>
                            <div class="w-full flex flex-col space-y-4  p-3 lg:w-2/3 lg:h-3/3 ">
                                <div class="flex justify-between item-center">
                                    <!-- TITULO -->
                                    <div class="flex items-center">
                                        <h3 class="font-black text-gray-800 text-2xl md:text-3xl lg:text-3xl dark:text-white">
                                            {!! $place->title !!}
                                        </h3>
                                    </div>
                                    <!-- FAVORITOS -->
                                    <div class="flex items-center">
                                        @can('create', App\Models\Place::class)
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
                                        @endcan
                                        <p class="pt-1 text-gray-600 font-bold text-sm ml-2 dark:text-white">
                                            {{ $place->favorited()->count() }}
                                        </p>
                                    </div>
                                </div>
                                <!-- DESCRIPCION -->
                                <p class="text-gray-500 text-lg md:text-lg lg:text-xl dark:text-white">
                                    {!! $place->description !!}
                                </p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                    {{ $places->links() }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>