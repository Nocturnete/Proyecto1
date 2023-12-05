@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
   </ul>
</div>
@endif
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-black text-5xl md:text-4xl lg:text-4xl lg:mt-3 dark:text-white">
            {{ __('Subir Publicación') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="w-full mx-auto h-full">
            <a href="{{ route('posts.index') }}" class="mt-5"><i class="fi-sr-angle-left mt-4 text-customblue">{{ __('Volver a publicaciones') }}</i></a>
        </div>
        <div class="bg-white p-8 rounded shadow-md ">
            <h1 class="text-2xl font-semibold mb-4">{{__('Detalles')}}</h1>
            <p class="text-lg font-semibold mb-2">{!! $post->title !!}</p>
            <p class="text-gray-600 mb-4">{!! $post->description !!}</p>
            <img src="{{ asset('storage/' . $post->file->filepath) }}" alt="Image" class="w-50 h-50 mb-4">
            @can('update', $post)
            <a href="{{ route('posts.edit', $post->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded mr-2">{{ __('Editar') }}</a>
            @endcan
            @can('delete', $post)
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded mr-2">{{ __('Eliminar') }}</button>
            </form>
            @endcan
        </div>
    </div>
</x-app-layout>