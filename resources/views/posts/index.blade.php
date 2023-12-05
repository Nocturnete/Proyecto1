<x-app-layout>
    <x-slot name="header">
        <h2 class="text-black font-semibold text-5xl md:text-4xl lg:text-4xl lg:mt-3 dark:text-white">
            {{ __('Publicaciones') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="w-full mx-auto">

            <!-- BUSCADOR -->
            <div class="lg:flex lg:justify-center mb-8">
                <form class="flex items-center w-full lg:w-96" action="{{ route('posts.search') }}" method="GET">
                    <div class="relative w-full">
                        <input type="search" name="search" placeholder="{{ __('Buscar') }}" class="bg-gray-200 h-10 px-5 pr-10 rounded-full text-sm focus:outline-none w-full">
                        <button type="submit" class="absolute inset-y-0 right-0 px-3 py-2">
                            <i class="fi-rr-search dark:text-black"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- CREAR PUBLICACION -->
            <div class="lg:m-6 flex items-center justify-center">
                <a href="{{ route('posts.create') }}">
                    <i class="fi-sr-add text-customblue text-4xl"></i>
                </a>
            </div>

            <!-- PUBLICACIONES -->
            @foreach ($posts as $post)
            @if ($post->visibility_id != 3 || (auth()->check() && auth()->user()->id === $post->author_id))
                <a href="{{ route('posts.show', $post->id) }}">
                    <div class="mt-5 mb-8 w-full mx-auto max-w-[800px] flex flex-col items-center"> 
                        <div class="rounded-lg shadow-lg w-96 bg-gray-200 dark:bg-gray-600">
                            <div class="w-full flex justify-between pt-2 pb-2">
                                <h1 class="flex-1 text-xl pl-5 font-semibold leading-none text-black dark:text-white">{{ $post->user ? $post->user->name : __('Usuario Desconocido') }}</h1>
                                <p class="flex-1 text-right pr-5 text-sm text-customgray dark:text-white">{{ $post->visibility->name }}</p>
                            </div>
                            <img src="{{ asset('storage/' . $post->file->filepath) }}" class="object-cover object-center w-full h-80 max-w-[500px] max-h-[500px]">
                            <div class="flex items-center justify-between pl-3 pt-1">
                                <div class="flex items-center mt-1">
                                    @can('create', App\Models\Post::class)
                                    @if(auth()->check() && auth()->user()->likes->contains($post->id))
                                        <form action="{{ route('posts.unlike', ['post' => $post->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"><i class="fi-sr-heart text-customred dark:text-white"></i></button>
                                        </form>
                                    @else
                                        <form action="{{ route('posts.likes', ['post' => $post->id]) }}" method="post">
                                            @csrf
                                            <button type="submit"><i class="fi-rr-heart dark:text-white"></i></button>
                                        </form>
                                    @endif
                                    @endcan
                                    <span class="text-sm pl-2 pb-1 dark:text-white">{{ $post->liked()->count() }} Me gusta</span>
                                </div>
                            </div>
                            <div class="space-y-3 ml-3 mr-3 pb-2">
                                <span class="text-md font-semibold dark:text-white">{{ $post->user ? $post->user->name : __('Usuario Desconocido') }}:</span>
                                <span class="text-sm dark:text-white">{!! $post->description !!}</span>
                            </div>
                        </div> 
                    </div>
                </a>
            @endif
            @endforeach
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>