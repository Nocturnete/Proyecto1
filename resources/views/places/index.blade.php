<x-app-layout>

    <x-slot name="header">
        <h2 class="text-black font-semibold text-5xl md:text-4xl lg:text-4xl lg:mt-3 dark:text-white">
            {{ __('Lugares') }}
        </h2>
    </x-slot>

    <div class="py-5 ">
        <div class="w-full mx-auto ">
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
            <!-- TARGETAS -->
            <div class="px-5 mb-10">
                @foreach ($places as $place)
                    <!-- TARGETA -->
                    @if ($place->visibility_id != 3 || (auth()->check() && auth()->user()->id === $place->author_id))
                        <a href="{{ route('places.show', $place->id) }}">
                            <div class="flex flex-col mx-auto my-auto mt-3 mb-6 bg-gray-200 md:w-3/5 lg:flex-row lg:w-4/6 dark:bg-gray-500">
                                <!-- IMAGEN -->
                                <div class="order-1 flex items-center justify-center bg-black">
                                    <img src="{{ asset('storage/' . $place->file->filepath) }}" class="object-cover h-80 lg:h-60 lg:w-100">
                                </div>
                                <!-- INFORMACION -->
                                <div class="order-2">
                                    <div class="flex justify-between">
                                        <!-- TITULO -->
                                        <h3 class="pl-3 pt-1 text-2xl w-full mr-2 font-semibold lg:text-4xl lg:mt-2 dark:text-white">
                                            {!! $place->title !!}
                                        </h3>
                                        <!-- FAVORITOS -->
                                        <div class="flex items-center pr-4 lg:mt-3">
                                            @can('create', App\Models\Place::class)
                                                @if(auth()->check() && auth()->user()->favorites->contains($place->id))
                                                    <form action="{{ route('places.unfavorites', ['place' => $place->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="pt-2"><i class="fi-sr-star ml-4 text-yellow-500 text-2xl"></i></button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('places.favorites', ['place' => $place->id]) }}" method="POST">
                                                        @csrf
                                                        <button class="pt-2"><i class="fi-sr-star ml-4 text-2xl dark:text-white"></i></button>
                                                    </form>
                                                @endif
                                            @endcan
                                            <p class="pt-1 text-gray-600 font-bold text-sm ml-2 dark:text-white">
                                                {{ $place->favorited()->count() }}
                                            </p>
                                        </div>
                                    </div>
                                    <!-- VISIBILIDAD -->
                                    <p class="pl-3 pb-2 text-sm md:text-md lg:mt-1 lg:mb-5 dark:text-white">{{ $place->visibility->name }}</p> 
                                    <!-- DESCRIPCION -->
                                    <p class="ml-3 mr-6 mb-2 text-md dark:text-white">{!! $place->descripcion !!}</p>
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach
                {{ $places->links() }}
            </div>
        </div>
    </div>
</x-app-layout>