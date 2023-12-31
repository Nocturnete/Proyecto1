<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <form id="validate-post-form" method="post" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data" class="bg-white p-4 rounded-lg shadow-md">
                        @csrf
                        @method('PUT')
                        <!-- Titulo -->
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 font-bold">{{ __('Titulo') }}:</label>
                            <input type="text" id="title" name="title" value="{{ $post->title }}" class="w-full p-2 border rounded-md">
                            @error('title')
                                <p id="title-error" class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Descripcion -->
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-bold">{{ __('Descripcion') }}:</label>
                            <textarea id="description" name="description" class="w-full p-2 border rounded-md" rows="4">{{ $post->description }}</textarea>
                            @error('description')
                                <p id="description-error" class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Visibilidad -->
                        <div class="mb-4">
                            <label for="visibility_id" class="block text-gray-700 font-bold">{{ __('Visibilidad') }}:</label>
                            <select id="visibility_id" name="visibility_id" class="w-full p-2 border rounded-md">
                                @foreach($visibilities as $visibility)
                                    <option value="{{ $visibility->id }}" @if($post->visibility_id == $visibility->id) selected @endif>{{ $visibility->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- IMAGEN ACTUAL -->
                        <div class="mb-4">
                            <label for="imagen" class="block text-gray-700 font-bold">{{ __('Imagen actual') }}:</label>
                            <img src="{{ asset('storage/' . $post->file->filepath) }}" alt="Image" class="w-20 mb-4">
                        </div>
                        <!-- IMAGEN NUEVA-->
                        <div class="mb-4">
                            <label for="upload" class="block text-gray-700 font-bold">{{ __('Selecciona un nuevo archivo') }}:</label>
                            <input type="file" id="upload" name="upload" class="w-full p-2 border rounded-md">
                            @error('upload')
                                <p id="upload-error" class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Botones -->
                        <div class="flex space-x-4">
                            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600">{{ __('Guardar') }}</button>
                            <a href="{{ route('posts.index') }}" class="bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-md hover:bg-gray-400">{{ __('Cancelar') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>