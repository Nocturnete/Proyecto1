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
    <div class="bg-white p-8 rounded shadow-md">
        <h1 class="text-2xl font-semibold mb-4">Detalles del Archivo</h1>
        <div class="mb-4">
            <strong>Tamaño del Archivo:</strong> {{ $file->filesize }} bytes
        </div>
        <div class="mb-4">
            <strong>Fecha de Subida:</strong> {{ $file->created_at }}
        </div>
        <hr class="my-4">
        <img class="img-fluid" src="{{ asset("storage/{$file->filepath}") }}" />
        <hr class="my-4">
        <a href="{{ route('files.edit', $file->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded mr-2">Editar</a>

        <form action="{{ route('files.destroy', $file->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded mr-2">Eliminar</button>
        </form>
        <a href="{{ route('files.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 px-4 rounded">Volver al Listado</a>
    </div>
</x-app-layout>