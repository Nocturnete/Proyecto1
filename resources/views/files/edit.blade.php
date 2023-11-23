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
            {{ __('Files') }}   
        </h2>
    </x-slot>

    <div class="bg-white p-8 rounded shadow-md">
        <h1 class="text-2xl font-semibold mb-4">{{ __('Editar Archivo') }}</h1>
        <form action="{{ route('files.update', $file->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="upload" class="block text-gray-700 text-sm font-bold mb-2">{{ __("Selecciona un nuevo archivo") }}:</label>
                <input type="file" name="upload" id="upload" accept=".jpg, .jpeg, .png" class="border rounded w-full py-2 px-3 text-gray-700">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">{{ __("Guardar Cambios") }}</button>
        </form>
        <a href="{{ route('files.show', $file->id) }}" class="mt-4 inline-block text-gray-500 hover:text-gray-700">{{ __('Volver') }}</a>
    </div>

</x-app-layout>