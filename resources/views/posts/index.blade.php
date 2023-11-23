<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-black text-5xl md:text-4xl lg:text-4xl lg:mt-3 dark:text-white">
            {{ __('Publicaciones') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="w-full mx-auto h-full">
            <!-- BUSCADOR -->
            <div class="lg:flex lg:justify-center">
                <form class="flex items-center mb-8" action="{{ route('posts.search') }}" method="GET">
                    <div class="relative w-full lg:w-96">
                        <input type="search" name="search" placeholder="Buscar"
                            class="bg-gray-200 h-10 px-5 pr-10 rounded-full text-sm focus:outline-none w-full">
                        <button type="submit" class="absolute inset-y-0 right-0 px-3 py-2">
                            <i class="fi-rr-search dark:text-black"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- CREAR LUGAR -->
            <div class="lg:m-6 flex items-center justify-center">
                <a href="{{ route('posts.create') }}">
                    <i class="fi-sr-add text-customblue text-4xl"></i>
                </a>
            </div>

            <!-- PUBLICACION -->
            <div class="w-full mx-auto h-full max-w-[800px]">

                <div class="w-full mx-auto h-full p-2 flex justify-center mt-5 overflow-y-hidden">
                    <div class="md:max-w-lg lg:max-w-xl container ">
                        @foreach ($posts as $post)
                        <a href="{{ route('posts.show', $post->id) }}">
                            <div class="mb-6 mt-2 p-3 bg-gray-200 rounded-2xl lg:transform lg:transition lg:duration-500 lg:hover:scale-105 lg:hover:shadow-2xl dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <div class="flex p-2 justify-between">
                                    <!-- USUARIO -->
                                    <div class="flex items-center space-x-2">
                                        <h2 class="text-gray-800 dark:text-white font-bold cursor-pointer">
                                            {{ $post->user ? $post->user->name : __('Usuario Desconocido') }}</h2>
                                    </div>

                                    <!-- LIKE -->
                                    <div class="flex space-x-2">
                                    @can('create', App\Models\Post::class)
                                    @if(auth()->check() && auth()->user()->likes->contains($post->id))
                                    <form action="{{ route('posts.unlike', ['post' => $post->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"><i class="fi-sr-heart text-customred"></i></button>
                                    </form>
                                    @else
                                    <form action="{{ route('posts.likes', ['post' => $post->id]) }}" method="post">
                                        @csrf
                                        <button type="submit"><i class="fi-sr-heart"></i></button>
                                    </form>
                                    @endif
                                    @endcan
                                    <p>{{ $post->liked()->count() }}</p>
                                    </div>
                                </div>

                                <!-- IMAGEN -->
                                <img class="w-full cursor-pointer rounded-lg max-h-[500px] max-w-[700px]"
                                    src="{{ asset('storage/' . $post->file->filepath) }}" alt="" />

                                <!-- Descripcion -->
                                <div>
                                    <div>
                                        {!! $post->title !!}
                                    </div>
                                    <div>
                                        {!! $post->description !!}
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>