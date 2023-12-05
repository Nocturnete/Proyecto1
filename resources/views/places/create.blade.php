<x-app-layout>

    <x-slot name="header">
        <h2 class="text-black font-semibold text-5xl md:text-4xl lg:text-4xl lg:mt-3 dark:text-white">
            {{ __('Crear Publicación') }}
        </h2>
    </x-slot>

    <div class="ml-3 mt-4 mb-4 md:mt-0 md:ml-4 lg:ml-0 lg:mt-4">
        <a href="{{ route('places.index') }}"><i class="fi-sr-angle-left text-md font-semibold text-customblue">{{ __('Volver a lugares') }}</i></a>
    </div>
    
    <div class="lg:flex lg:flex-col lg:items-center lg:justify-center ">
        <form id="create-place-form" class="px-4 pb-16 lg:w-2/5 lg:mt-5" action="{{ route('places.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="lg:rounded-lg lg:p-8 lg:shadow-lg lg:bg-customgray3  dark:lg:bg-customgray">
                <!-- TITULO -->
                <div class="mb-4">
                    <label for="title" class="block font-bold text-gray-700 text-md dark:text-white">{{ __('Titulo') }}:</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="block w-full shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-500 dark:text-white @error('title') border-red-500 @enderror">
                    @if(!empty($errors->first('title')))
                        <p id="title-error" class="mt-2 text-red-500 text-sm">{{ $errors->first('title') }}</p>
                    @endif
                </div>
                <!-- LATITUT -->
                <div class="mb-4">
                    <label for="latitude" class="block font-bold text-gray-700 text-md dark:text-white">{{ __('Latitud') }}:</label>
                    <input type="text" name="latitude" id="latitude" value="{{ old('latitude') }}" class="block w-full shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-500 dark:text-white @error('latitude') border-red-500 @enderror">
                    @error('latitude')
                        <p id="latitude-error" class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <!-- LONGITUD -->
                <div class="mb-4">
                    <label for="longitude" class="block font-bold text-gray-700 text-md dark:text-white">{{ __('Longitude') }}:</label>
                    <input type="text" name="longitude" id="longitude" value="{{ old('longitude') }}"  class="block w-full shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-500 dark:text-white @error('longitude') border-red-500 @enderror">
                    @error('longitude')
                        <p id="longitude-error" class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <!-- DESCRIPCION -->
                <div class="mb-4">
                    <label for="descripcion" class="block font-bold text-gray-700 text-md dark:text-white">{{ __('Descripcion') }}:</label>
                    <textarea name="descripcion" id="descripcion" rows="2" class="block w-full shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-500 dark:text-white @error('descripcion') border-red-500 @enderror"></textarea>
                    @error('descripcion')
                        <p id="descripcion-error" class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <!-- IMAGEN -->
                <div class="mb-4">
                    <label for="upload" class="block font-bold text-gray-700 text-md dark:text-white">{{ __('Imagen') }}:</label>
                    <input type="file" name="upload" id="upload" value="{{ old('upload') }}" class="w-full p-2 border rounded-md dark:text-white @error('upload') border-red-500 @enderror">
                    @error('upload')
                        <p id="upload-error" class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <!-- VISIBILIDAD -->
                <div class="mb-4">
                    <label for="visibility_id" class="block font-bold text-gray-700 text-md dark:text-white">{{ __('Visibilidad') }}:</label>
                    <select id="visibility_id" name="visibility_id" class="w-full p-2 border rounded-md">
                        @foreach($visibilities as $visibility)
                            <option value="{{ $visibility->id }}">{{ $visibility->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- BOTONES -->
                <div class="flex justify-center mt-5 pb-5">
                    <button type="reset" class="bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-md hover:bg-gray-400">{{ __('Limpiar') }}</button>
                    <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 ml-5 rounded-md hover:bg-blue-600">{{ __('Crear') }}</button>
                </div>
            </div>
        </form>
    </div>

</x-app-layout>