<x-app-layout>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Posts') }}
       </h2>
   </x-slot>

   <div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 h-full">
        <a href="{{ route('posts.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md mb-4 inline-block">Añadir imagen</a>
        <form action="{{ route('posts.search') }}" method="GET">
            <div class="mb-4">
                <label for="search" class="block text-gray-700 font-bold">Buscar</label>
                <input type="text" id="search" name="search" class="w-full p-2 border rounded-md">
            </div>
            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600">Buscar</button>
        </form>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-full">
            <div class="p-6 bg-white border-b border-gray-200 h-full">
                @foreach ($posts as $post)
                <div class="mb-6 p-4 bg-gray-100 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <span class="font-semibold text-lg text-blue-600">{{ $post->user ? $post->user->name : 'Usuario Desconocido' }}</span>
                    </div>
                    <h1 class="text-2xl font-semibold text-blue-600 mb-2">{{ $post->title }}</h1>
                    <!-- <p class="text-gray-800">{{ $post->description }}</p> -->
                    <a href="{{ route('posts.show', $post->id) }}">
                        <img src="{{ asset('storage/' . $post->file->filepath) }}" alt="Imagen" class="mt-4 w-full rounded-lg shadow-md">
                    </a>
                </div>
                @endforeach
            </div>
            {{ $posts->links() }}
        </div>
    </div>
    </div>
</x-app-layout>
