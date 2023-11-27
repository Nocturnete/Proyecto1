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
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Places') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('places.update', $place->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded-lg shadow-md">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 font-bold">{{ __('Titulo') }}:</label>
                            <input type="text" name="title" value="{{ $place->title }}" class="w-full p-2 border rounded-md" id="title">
                        </div>
                        <div class="mb-4">
                            <label for="latitude" class="block text-gray-700 font-bold">{{ __('Latitud') }}:</label>
                            <input type="text" name="latitude" value="{{ $place->latitude }}" class="w-full p-2 border rounded-md" id="latitude">
                        </div>
                        <div class="mb-4">
                            <label for="longitude" class="block text-gray-700 font-bold">{{ __('Longitud') }}:</label>
                            <input type="text" name="longitude" value="{{ $place->longitude }}" class="w-full p-2 border rounded-md" id="longitude">
                        </div>
                        <div class="mb-4">
                            <label for="descripcion">{{ __('Descripcion') }}:</label>
                            <textarea name="descripcion" id="descripcion" class="w-full p-2 border rounded-md" rows="4">{{ $place->descripcion }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="visibility_id" class="block text-gray-700 font-bold">{{ __('Visibilidad') }}:</label>
                            <select id="visibility_id" name="visibility_id" class="w-full p-2 border rounded-md">
                                @foreach($visibilities as $visibility)
                                    <option value="{{ $visibility->id }}" @if($place->visibility_id == $visibility->id) selected @endif>{{ $visibility->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="imagen" class="block text-gray-700 font-bold">{{ __('Imagen actual') }}:</label>
                            <img src="{{ asset('storage/' . $place->file->filepath) }}" alt="Image" class="w-200 mb-4">
                        </div>
                        <div class="mb-4">
                            <label for="upload" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Selecciona un nuevo archivo') }}:</label>
                            <input type="file" name="upload" id="upload" class="border rounded w-full py-2 px-3 text-gray-700">
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">{{ __('Guardar') }}</button>
                    </form>
                    <a href="{{ route('places.index') }}" class="mt-4 inline-block text-gray-500 hover:text-gray-700">{{ __('Volver') }}</a>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>