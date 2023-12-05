<x-app-layout>

    <x-slot name="header">
        <h2 class="flex justify-center text-black font-semibold text-5xl md:text-4xl md:mt-4 lg:pt-3 lg:text-4xl dark:text-white">
            {{ __('Edit Places') }}
        </h2>
    </x-slot>

    <div class="w-full mt-6 mb-5 ml-2">
        <a href="{{ route('places.show', $place->id) }}"><i class="fi-sr-angle-left text-md font-semibold text-customblue">{{ __('Volver al lugar') }}</i></a>
    </div>

    <form action="{{ route('places.update', $place->id) }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PUT')
        <div class="ml-2 mr-2 rounded-md">
            <div class="flex flex-col ">

                <div class="mb-4">
                     <label for="title" class="block font-bold text-gray-700 text-xl dark:text-white">{{ __('Titulo') }}:</label>
                    <input type="text" name="title" id="title" value="{{ $place->title }}" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm rounded-md dark:bg-gray-500 dark:text-white border @error('title') border-red-500 @enderror">
                    @if(!empty($errors->first('title')))
                        <p id="title-error" class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @endif
                </div>
                <div class="mb-4">
                    <label for="latitude" class="block text-xl font-bold text-gray-700 dark:text-white">{{ __('Latitud') }}:</label>
                    <input type="text" name="latitude" id="latitude" value="{{ $place->latitude }}" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm rounded-md dark:bg-gray-500 dark:text-white @error('latitude') border-red-500 @enderror">
                    @error('latitude')
                        <p id="latitude-error" class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="longitude" class="block text-xl font-bold text-gray-700 dark:text-white">{{ __('Longitude') }}:</label>
                    <input type="text" name="longitude" id="longitude" value="{{ $place->longitude }}"  class=" focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm rounded-md dark:bg-gray-500 dark:text-white @error('longitude') border-red-500 @enderror">
                    @error('longitude')
                        <p id="longitude-error" class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="descripcion" class="block text-xl font-bold text-gray-700 dark:text-white">{{ __('Descripcion') }}:</label>
                    <textarea name="descripcion" id="descripcion" rows="3" value="{{ $place->descripcion }}" class="focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full rounded-md dark:bg-gray-500 dark:text-white @error('descripcion') border-red-500 @enderror"></textarea>
                    @error('descripcion')
                        <p id="descripcion-error" class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="upload" class="block text-xl font-bold text-gray-700 pb-2 dark:text-white">{{ __('Imagen') }}:</label>
                    <input type="file" name="upload" id="upload" value="{{ $place->upload }}" class="w-full p-2 border border-indigo-500 focus:border-indigo-500 rounded-md dark:text-white @error('upload') border-red-500 @enderror">
                    @error('upload')
                        <p id="upload-error" class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="visibility_id" class="block text-xl pb-2 font-bold text-gray-700 dark:text-white">{{ __('Visibilidad') }}:</label>
                    <select id="visibility_id" name="visibility_id" class="w-full p-2 border rounded-md">
                        @foreach($visibilities as $visibility)
                            <option value="{{ $visibility->id }}">{{ $visibility->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-center mt-5">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">{{ __('Guardar') }}</button>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>