<h1>{{ __('Nuevo commentario') }}</h1>
<div>
    <form id="create-comment-form" class="px-4 pb-16 lg:w-2/5 lg:mt-5" action="{{ route('comment.store', ['id' => $id]) }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="mb-4">
            <label for="comment" class="block font-bold text-gray-700 text-md dark:text-white">{{ __('Comentario') }}:</label>
            <textarea name="comment" id="comment" rows="2" class="block w-full shadow-sm rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-500 dark:text-white"></textarea>
        </div>
        <div class="flex justify-center mt-5 pb-5">
            <button type="reset" class="bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-md hover:bg-gray-400">{{ __('Limpiar') }}</button>
            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 ml-5 rounded-md hover:bg-blue-600">{{ __('Crear') }}</button>
        </div>    
    </form>
</div>