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
        <h1 class="text-2xl font-semibold mb-4">Detalles del Lugar</h1>
        <p class="text-lg font-semibold mb-2">Titulo: {!! $place->title !!}</p>
        <p>Favoritos: {{ $place->favorited()->count() }}</p>
        <p class="text-gray-600 mb-4">Latitut: {{ $place->latitude }}</p>
        <p class="text-gray-600 mb-4">Longitud: {{ $place->longitude }}</p>
        <p class="text-gray-600 mb-4">Descripción: {!! $place->descripcion !!}</p>
        <img src="{{ asset('storage/' . $place->file->filepath) }}" alt="Image" class="w-50 h-50 mb-4" />
        <a href="{{ route('places.edit', $place->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded mr-2">Editar</a>
        <form action="{{ route('places.destroy', $place->id) }}" method="POST" class="inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded mr-2">Eliminar</button>
        </form>
        <a href="{{ route('places.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 px-4 rounded">Volver</a>
    </div>
</x-app-layout>