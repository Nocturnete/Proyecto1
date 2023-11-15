<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Place') }}   
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Create Place</h1>
                    <form method="POST" action="{{ route('places.store') }}" enctype="multipart/form-data" class="bg-white p-4 rounded-lg shadow-md">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 font-bold">Titulo:</label>
                            <input type="text" name="title" id="title" class="w-full p-2 border rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="latitude" class="block text-gray-700 font-bold">Latitud:</label>
                            <input type="text" name="latitude" id="latitude" class="w-full p-2 border rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="longitude" class="block text-gray-700 font-bold">Longitud:</label>
                            <input type="text" name="longitude" id="longitude" class="w-full p-2 border rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="descripcion" class="block text-gray-700 font-bold">Descripcion:</label>
                            <textarea type="text" name="descripcion" id="descripcion" class="w-full p-2 border rounded-md" rows="4"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="upload" class="block text-gray-700 font-bold">Imagen:</label>
                            <input type="file" name="upload" id="upload" class="w-full p-2 border rounded-md">
                        </div>
                        <div class="flex space-x-4">
                            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600">Crear</button>
                            <button type="reset" class="bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-md hover:bg-gray-400">Limpiar</button>
                            <button type="reset" class="bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-md hover:bg-gray-400"> <a href="{{ route('places.index') }}">Volver</a></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>