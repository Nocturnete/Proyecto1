<x-app-layout>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Places') }}
       </h2>
   </x-slot>

   <div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 h-full">
        <a href="{{ route('places.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md mb-4 inline-block">Añadir imagen</a>
        <form action="{{ route('places.search') }}" method="GET">
            <div class="mb-4">
                <label for="search" class="block text-gray-700 font-bold">Buscar</label>
                <input type="text" id="search" name="search" class="w-full p-2 border rounded-md">
                <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600">Buscar</button>
            </div>
        </form>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full">
            <div class="p-6 bg-white border-b border-gray-200 h-full">
                @foreach ($places as $place)
                <div class="mb-6 p-4 bg-gray-100 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <span class="font-semibold text-lg text-blue-600">{{ $place->user ? $place->user->name : 'Usuario Desconocido' }}</span>
                    </div>
                    <h1 class="text-2xl font-semibold text-blue-600 mb-2">{{ $place->title }}</h1>
                    <p class="text-gray-800">{{ $place->description }}</p>
                    <a href="{{ route('places.show', $place->id) }}">
                        <img src="{{ asset('storage/' . $place->file->filepath) }}" alt="Imagen" class="mt-4 w-full rounded-lg shadow-md">
                    </a>
                </div>
                @if(auth()->check() && auth()->user()->favorites->contains($place->id))
                    <form action="{{ route('places.unfavorites', ['place' => $place->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Unfavorite</button>
                    </form>
                @else
                    <form action="{{ route('places.favorites', ['place' => $place->id]) }}" method="POST">
                        @csrf
                        <button type="submit">Favorite</button>
                    </form>
                @endif
                <p>{{ $place->favorited()->count() }}</p>
                @endforeach
            </div>
            {{ $places->links() }}
        </div>

    </div>
    </div>
</x-app-layout>
