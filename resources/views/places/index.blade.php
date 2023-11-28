<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-black text-5xl md:text-4xl lg:text-4xl lg:mt-3 dark:text-white">
            {{ __('Lugares') }}
        </h2>
    </x-slot>
    <div class="py-5">
        <div class="w-full mx-auto">
            <!-- BUSCADOR -->
            <div class="lg:flex lg:justify-center">
                <form class="flex items-center mb-8" action="{{ route('places.search') }}" method="GET">
                    <div class="relative w-full lg:w-80">
                        <input type="search" name="search" placeholder="{{ __('Buscar') }}" class="bg-gray-200 h-10 px-5 pr-10 rounded-full text-sm focus:outline-none w-full">
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
            <!-- TARGETA -->
            @foreach ($places as $place)
                @if ($place->visibility_id != 3 || (auth()->check() && auth()->user()->id === $place->author_id))
                    <a href="{{ route('places.show', $place->id) }}">
                        <div class="rounded-md shadow-md max-w-[900px] flex flex-col md:flex-row mb-8 mt-3 bg-gray-200 dark:bg-gray-500">
                            <!-- IMAGEN -->
                            <div class="w-1/2">
                                <img src="{{ asset('storage/' . $place->file->filepath) }}" class="object-cover object-center w-full h-full max-w-[500px] max-h-[500px]">
                            </div>
                            <!-- CONTENIDO -->
                            <div class="w-1/2 w-full">
                                <div class="h-full">
                                    <div class="flex justify-between mt-3">
                                        <!-- TITULO -->
                                        <h3 class="text-2xl pl-3 pt-3 md:text-3xl lg:text-3xl dark:text-white">
                                            {!! $place->title !!}
                                        </h3>
                                        <!-- FAVORITOS -->
                                        <div class="flex items-center pr-4">
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
                                                        <button class="ml-8 pt-2"><i class="fi-sr-star ml-3 text-2xl dark:text-white"></i></button>
                                                    </form>
                                                @endif
                                            @endcan
                                            <p class="pt-1 text-gray-600 font-bold text-sm ml-2 dark:text-white">
                                                {{ $place->favorited()->count() }}
                                            </p>
                                        </div>
                                    </div>
                                    <!-- VISIBILIDAD -->
                                    <p class="ml-3 text-lg dark:text-white">{{ $place->visibility->name }}</p> 
                                    <!-- DESCRIPCION -->
                                    <p class="ml-3 mt-4 pr-3 mb-4 text-xl dark:text-white">{!! $place->descripcion !!}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach
            {{ $places->links() }}
        </div>
    </div>
</x-app-layout>