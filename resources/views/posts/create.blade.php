<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-black text-5xl md:text-4xl lg:text-4xl lg:mt-3 dark:text-white">
            {{ __('Subir Publicación') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="w-full mx-auto h-full">
            <a href="{{ route('posts.index') }}" class="mt-5"><i class="fi-sr-angle-left mt-4 text-customblue">{{ __('Volver a publicaciones') }}</i></a>
            <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data" class="bg-white mt-5 p-4 rounded-lg dark:bg-gray-700">
            @csrf
                <!-- Titulo -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-bold dark:text-white ">{{ __('Titulo') }}:</label>
                    <input type="text" id="title" name="title" class="w-full p-2 border rounded-md dark:bg-gray-500 dark:text-white">
                </div>
                <!-- Descripcion -->
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-bold dark:text-white ">{{ __('Descripcion') }}:</label>
                    <textarea id="description" name="description" class="w-full p-2 border rounded-md dark:bg-gray-500 dark:text-white" rows="4"></textarea>
                </div>
                <!-- IMAGEN -->
                <div class="mb-4">
                    <label for="upload" class="block text-gray-700 font-bold dark:text-white ">{{ __('Imagen') }}:</label>
                    <input type="file" id="upload" name="upload" class="w-full p-2 rounded-md dark:text-white">
                </div>
                <!-- Vista Previa -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600 dark:text-white">{{ __('Vista Previa de la Imagen') }}</label>
                </div>
                <!-- Botones -->
                <div class="flex space-x-4">
                    <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600">{{ __('Crear') }}</button>
                    <button type="reset" class="bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-md hover:bg-gray-400">{{ __('Limpiar') }}</button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
