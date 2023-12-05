<x-app-layout>
    <div class="bg-white p-8 rounded lg:shadow-md dark:bg-customgray">
        <!-- TITULO -->
        <h1 class="flex justify-center text-black font-semibold text-5xl md:text-4xl lg:text-4xl dark:text-white">
            {!! $place->title !!}
        </h1>
        <!-- VOLVER -->
        <div class="w-full mt-6 mb-5">
            <a href="{{ route('places.index') }}"><i class="fi-sr-angle-left text-md font-semibold text-customblue">{{ __('Volver a lugares') }}</i></a>
        </div>
        <div class="ml-2 mr-2">
            <div class="flex flex-col ">
                <!-- FAVORITOS -->
                <div class="mb-4 flex">
                    <p class="block text-xl font-bold text-gray-700 dark:text-white mr-2">{{ __('Favoritos') }}: </p>
                    <p class="block text-md lg:pt-1 text-gray-700 dark:text-white">{!! $place->favorited()->count() !!}</p>
                </div>  
                <!-- LATITUD -->
                <div class="mb-4 flex">
                    <p class="block text-xl font-bold text-gray-700 dark:text-white mr-2">{{ __('Latitud') }}: </p>
                    <p class="block text-md lg:pt-1 text-gray-700 dark:text-white">{!! $place->latitude !!}</p>
                </div>
                <!-- LONGITUD -->
                <div class="mb-4 flex">
                    <p class="block text-xl font-bold text-gray-700 dark:text-white mr-2">{{ __('Longitude') }}:</p>
                    <p class="blocktext-md lg:pt-1 text-gray-700 dark:text-white">{!! $place->longitude !!}</p>
                </div>
                <!-- DESCRIPCION -->
                <div class="mb-4">
                    <p class="block text-xl font-bold text-gray-700 dark:text-white">{{ __('Descripcion') }}:</p>
                    <p class="block text-md lg:pt-1 text-gray-700 dark:text-white">{!! $place->descripcion !!}</p>
                </div>
                <!-- IMAGEN -->
                <div class="mb-4">
                    <p class="block text-xl font-bold text-gray-700 pb-2 dark:text-white">{{ __('Imagen') }}:</p>
                    <img src="{{ asset('storage/' . $place->file->filepath) }}" alt="Image" class="w-50 h-50 mb-4 md:max-w-800" />
                </div>
            </div>
        </div>
        <!-- BOTONES -->
        <div class="flex justify-center mt-5">
            @can('delete', $place)
                <form action="{{ route('places.destroy', $place->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-md text-white font-bold pt-2 pb-2 pl-4 pr-4 mr-6 rounded-md hover:bg-gray-400">{{ __('Eliminar') }}</button>
                </form>
            @endcan

            @can('update', $place)
                <a href="{{ route('places.edit', $place->id) }}" class="bg-blue-500 text-md text-white font-bold pt-2 pb-2 pl-6 pr-6 ml-6 rounded-md hover:bg-blue-600">{{ __('Editar') }}</a>
            @endcan
        </div>
    </div>
</x-app-layout>