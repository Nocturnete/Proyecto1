@include('comments.create', ['id' => $post->id])

@foreach ($post->comments as $comment)
    <div class="bg-gray-100 rounded-lg p-4 mb-4">
        <div class="text-gray-700 mb-2">
            <p class="font-semibold">Autor: {{$post->user->name}}</p>
            <p>{{$comment->comment}}</p>
        </div>
        @can('delete', $comment)
            <form action="{{ route('comment.delete', ['id' => $comment->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-md text-white font-semibold py-2 px-4 rounded-md hover:bg-gray-400">{{ __('Eliminar') }}</button>
            </form>
        @endcan
    </div>
@endforeach