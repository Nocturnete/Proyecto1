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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form id="create-file-form" method="post" action="{{ route('files.store') }}" enctype="multipart/form-data"> 
                        @csrf
                        <div class="form-group">
                            <label for="upload">{{ __("Imagen") }}:</label>
                            <input type="file" class="form-control" name="upload"/>
                            @error('upload')
                                <p id="upload-error" class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __("Crear") }}</button>
                        <button type="reset" class="btn btn-secondary">{{ __("Cancelar") }}</button>
                        <a href="{{ route('files.index') }}">{{ __("Volver") }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>