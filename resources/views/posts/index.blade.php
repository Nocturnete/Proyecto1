<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-black text-5xl md:text-4xl lg:text-4xl lg:mt-3 dark:text-white">
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
                    <div class="mb-8 border w-full mx-auto max-w-[800px]"> 
                        <div class="rounded-md shadow-md sm:w-96 bg-coolGray-900 text-coolGray-100">
                            <div class="flex items-center justify-between p-3">
                                <div class="flex items-center space-x-2">
                                    <div class="-space-y-1">
                                        <h1 class="text-2xl font-semibold leading-none">{{ $post->user ? $post->user->name : __('Usuario Desconocido') }}</h1>
                                        <p class="text-gray-600 dark:text-gray-400">Estado: {{ $post->visibility->name }}</p>
                                    </div>
                                </div>
                            </div>
                            <img src="{{ asset('storage/' . $post->file->filepath) }}" alt="" class="object-cover object-center w-full h-full max-w-[500px] max-h-[500px]">
                            <div class="p-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
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
                                                <button type="submit"><i class="fi-rr-heart"></i></button>
                                            </form>
                                        @endif
                                        @endcan
                                        <span class="text-sm">{{ $post->liked()->count() }} Me gusta</span>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <p class="text-sm">
                                        <span class="text-lg font-semibold">{{ $post->user ? $post->user->name : __('Usuario Desconocido') }}</span>: {!! $post->description !!} 
                                    </p>
                                </div>
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