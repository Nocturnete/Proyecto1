<x-app-layout>
   <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Files') }}
       </h2>
   </x-slot>

   <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table">
                        <thead>
                            <tr>
                                <td scope="col">ID</td>
                                <td scope="col">Filepath</td>
                                <td scope="col">Filesize</td>
                                <td scope="col">Created</td>
                                <td scope="col">Updated</td>
                                <td scope="col">Ver</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($files as $file)
                            <tr>
                                <td>{{ $file->id }}</td>
                                <td>{{ $file->filepath }}</td>
                                <td>{{ $file->filesize }}</td>
                                <td>{{ $file->created_at }}</td>
                                <td>{{ $file->updated_at }}</td>
                                <td><a href="{{ route('files.show', $file->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded mr-2">Ver</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr class="my-4">
                    <a href="{{ route('files.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded mr-2" role="button">Añadir imagen</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
