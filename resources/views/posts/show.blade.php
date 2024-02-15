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
    <div class="bg-white p-8 rounded lg:shadow-md dark:bg-customgray">
        <!-- TITULO -->
        <h1 class="flex justify-center text-black font-semibold text-5xl md:text-4xl lg:text-4xl dark:text-white">
            {!! $post->title !!}
        </h1>
        <!-- VOLVER -->
        <div class="w-full mt-6 mb-5">
            <a href="{{ route('posts.index') }}"><i class="fi-sr-angle-left text-md font-semibold text-customblue">{{ __('Volver a lugares') }}</i></a>
        </div>
        <div class="ml-2 mr-2">
            <div class="flex flex-col ">
                <!-- ME GUSTA -->
                <div class="mb-4 flex">
                    <p class="block text-xl font-bold text-gray-700 dark:text-white mr-2">{{ __('Likes') }}: </p>
                    <p class="block text-xl text-gray-700 dark:text-white">{!! $post->liked()->count() !!}</p>
                </div>  
                <!-- DESCRIPCION -->
                <div class="mb-4">
                    <p class="block text-xl font-bold text-gray-700 dark:text-white">{{ __('Descripcion') }}:</p>
                    <p class="block text-xl text-gray-700 dark:text-white">{!! $post->description !!}</p>
                </div>
                <!-- IMAGEN -->
                <div class="mb-4">
                    <p class="block text-xl font-bold text-gray-700 pb-2 dark:text-white">{{ __('Imagen') }}:</p>
                    <img src="{{ asset('storage/' . $post->file->filepath) }}" alt="Image" class="w-50 h-50 mb-4">
                </div>
            </div>
        </div>

        <!-- BOTONES -->
        <div class="flex justify-center mt-5">
            @can('delete', $post)
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-md text-white font-bold pt-2 pb-2 pl-4 pr-4 mr-6 rounded-md hover:bg-gray-400">{{ __('Eliminar') }}</button>
                </form>
            @endcan

            @can('update', $post)
                <a href="{{ route('posts.edit', $post->id) }}" class="bg-blue-500 text-md text-white font-bold pt-2 pb-2 pl-6 pr-6 ml-6 rounded-md hover:bg-blue-600">{{ __('Editar') }}</a>
            @endcan
        </div>
    </div>
</x-app-layout>