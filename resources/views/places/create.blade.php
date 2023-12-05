<x-app-layout>

    <x-slot name="header">
        <h2 class="flex justify-center text-black font-semibold text-5xl md:text-4xl lg:text-4xl dark:text-white">
            {{ __('Create Place') }}
        </h2>
    </x-slot>

    <!-- VOLVER -->
    <div class="w-full mt-6 mb-5 ml-2">
        <a href="{{ route('places.index') }}"><i class="fi-sr-angle-left text-md font-semibold text-customblue">{{ __('Volver a lugares') }}</i></a>
    </div>

    <form id="create-place-form" action="{{ route('places.store') }}" enctype="multipart/form-data" method="POST">
        @csrf
  
        <div class="ml-2 mr-2 rounded-md">
            
            <div class="flex flex-col ">

                    <div class="mb-4">
                        <label for="title" class="block font-bold text-gray-700 text-xl dark:text-white">{{ __('Titulo') }}:</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm rounded-md dark:bg-gray-500 dark:text-white border @error('title') border-red-500 @enderror">
                        @if(!empty($errors->first('title')))
                            <p id="title-error" class="mt-2 text-red-500 text-sm">{{ $errors->first('title') }}</p>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label for="latitude" class="block text-xl font-bold text-gray-700 dark:text-white">{{ __('Latitud') }}:</label>
                        <input type="text" name="latitude" id="latitude" value="{{ old('latitude') }}" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm rounded-md dark:bg-gray-500 dark:text-white @error('latitude') border-red-500 @enderror">
                        @error('latitude')
                            <p id="latitude-error" class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="longitude" class="block text-xl font-bold text-gray-700 dark:text-white">{{ __('Longitude') }}:</label>
                        <input type="text" name="longitude" id="longitude" value="{{ old('longitude') }}"  class=" focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm rounded-md dark:bg-gray-500 dark:text-white @error('longitude') border-red-500 @enderror">
                        @error('longitude')
                            <p id="longitude-error" class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="descripcion" class="block text-xl font-bold text-gray-700 dark:text-white">{{ __('Descripcion') }}:</label>
                        <textarea name="descripcion" id="descripcion" rows="3" value="{{ old('descripcion') }}" class="focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full rounded-md dark:bg-gray-500 dark:text-white @error('descripcion') border-red-500 @enderror"></textarea>
                        @error('descripcion')
                            <p id="descripcion-error" class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="upload" class="block text-xl font-bold text-gray-700 pb-2 dark:text-white">{{ __('Imagen') }}:</label>
                        <input type="file" name="upload" id="upload" value="{{ old('upload') }}" class="w-full p-2 border border-indigo-500 focus:border-indigo-500 rounded-md dark:text-white @error('upload') border-red-500 @enderror">
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

            </div>
            
        </div>

        <div class="flex justify-center mt-5">
            <button type="reset" class="bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-md hover:bg-gray-400">{{ __('Limpiar') }}</button>
            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 ml-5 rounded-md hover:bg-blue-600">{{ __('Crear') }}</button>
        </div>
    
    </form>

</x-app-layout>