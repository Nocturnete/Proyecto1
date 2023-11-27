<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\User;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Storage;
use App\Models\Like;
use App\Models\Visibility; 

class PostController extends Controller
{
    /**
     * 
     * Constructor del controlador.
     * 
     */
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    public function index()
    {
        // return view("posts.index", [
        //     "posts" => Post::paginate(5),
        // ]);
        return view("posts.index", [
            "posts" => Post::with('visibility')->paginate(5), 
        ]);
    }

    /**
     * 
     * Muestra el formulario para crear un nuevo recurso.
     * 
     */
    public function create()
    {
        $visibilities = Visibility::all();
        return view("posts.create", compact('visibilities'));
        // return view("posts.create");
    }

    /**
     * 
     * Almacena un recurso recién creado en el almacenamiento.
     * 
     */
    public function store(Request $request)
    {
        // Validación de los datos de entrada.
        $validatedData = $request->validate([
            'upload' => 'required|mimes:gif,jpeg,jpg,png|max:1024',
            'title' => 'required|max:20',
            'description' => 'required|max:200',
            'visibility_id' => 'required|exists:visibilities,id', 
        ]);

        // Obtención de los datos del formulario.
        $upload = $request->file('upload');
        $fileName = $upload->getClientOriginalName();
        $fileSize = $upload->getSize();

        \Log::debug("Storing file '{$fileName}' ($fileSize)...");

        // Almacenamiento del archivo en el sistema de archivos y la base de datos.
        $uploadName = time() . '_' . $fileName;
        $filePath = $upload->storeAs(
            'uploads',
            $uploadName,
            'public'
        );

        if (\Storage::disk('public')->exists($filePath)) {

            \Log::debug("Disk storage OK");

            $fullPath = \Storage::disk('public')->path($filePath);

            \Log::debug("File saved at {$fullPath}");

            // Creación de la entrada del archivo en la base de datos.
            $file = File::create([
                'filepath' => $filePath,
                'filesize' => $fileSize,
            ]);

            \Log::debug("DB storage OK");

            // Creación de la publicación en la base de datos.
            $post = Post::create([
                'author_id' => $user = auth()->user()->id,
                'file_id' => $file->id,
                'title' => $request->title,
                'description' => $request->description,
                'visibility_id' => $request->visibility_id, 
            ]);

            return redirect()->route('posts.show', $post)
                ->with('success', 'File successfully saved');
                
        } else {

            \Log::debug("Disk storage FAILS");

            return redirect()->route("posts.create")
                ->with('error', 'ERROR uploading file');
        }
    }

    /**
     * 
     * Muestra el recurso especificado.
     * 
     */
    public function show(Post $post)
    {
        $fileExists = Storage::disk('public')->exists($post->file->filepath);

        if (!$fileExists) {
            return redirect()->route('posts.index')->with('error', 'Archivo no encontrado');
        }

        if (!$post->id) {
            return redirect()->route('posts.index')->with('error', 'Publicación no encontrada');
        }

        return view('posts.show', compact('post'));
    }

    /**
     * 
     * Muestra el formulario para editar el recurso especificado.
     * 
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * 
     * Actualizar el recurso especificado en el almacenamiento.
     *
     */
    public function update(Request $request, Post $post)
    {
        // Validar los datos del formulario.
        $request->validate([
            'upload' => 'mimes:gif,jpeg,jpg,png|max:1024',
            'title' => 'required|max:20',
            'description' => 'required|max:200',
            'visibility_id' => 'required|exists:visibilities,id', 
        ]);

        // Si hay un nuevo archivo, eliminar el antiguo y almacenar el nuevo.
        if ($request->hasFile('upload')) {
            Storage::disk('public')->delete($post->file->filepath);

            $newFile = $request->file('upload');
            $newFileName = time() . '_' . $newFile->getClientOriginalName();
            $newFilePath = $newFile->storeAs('uploads', $newFileName, 'public');
            $post->file->update([
                'original_name' => $newFile->getClientOriginalName(),
                'filesize' => $newFile->getSize(),
                'filepath' => $newFilePath,
            ]);
        }

        // Actualizar los detalles de la publicación en la base de datos.
        $post->update([
            'author_id' => $user = auth()->user()->id,
            'file_id' => $post->file->id,
            'title' => $request->title,
            'description' => $request->description,
            'visibility_id' => $request->visibility_id, 
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Archivo actualizado con éxito');
    }

    /**
     * 
     * Eliminar el recurso especificado del almacenamiento.
     *
     */
    public function destroy(Post $post)
    {
        // Eliminar el archivo asociado al post.
        Storage::disk('public')->delete($post->file->filepath);

        // Eliminar la entrada del post y la entrada del archivo en la base de datos.
        $post->delete();
        $post->file->delete();

        return redirect()->route('posts.index')->with('success', 'Archivo eliminado con éxito');
    }

    /**
     * 
     * Buscar publicaciones que coincidan con el término de búsqueda.
     *
     */
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $posts = Post::where('title', 'like', '%' . $searchTerm . '%')->paginate(5);

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * 
     * Dar "like" a una publicación.
     *
     */
    public function like(Post $post)
    {
        $this->authorize('create', $post);
        $user = auth()->user();

        // Verificar si el usuario ya ha dado "like" a esta publicación.
        if (!$user->likes->contains($post->id)) {
            $user->likes()->attach($post);
            return redirect()->route('posts.index')->with('success', 'Like guardado');
        }

        return redirect()->route('posts.index')->with('error', 'Ya has dado like a esta publicación');
    }

    /**
     * 
     * Eliminar el "like" de una publicación.
     *
     */
    public function unlike(Post $post)
    {
        $this->authorize('create', $post);
        $user = auth()->user();

        // Verificar si el usuario ha dado "like" a esta publicación antes de intentar eliminarlo.
        if ($user->likes->contains($post->id)) {
            $user->likes()->detach($post);
            return redirect()->route('posts.index')->with('success', 'Like eliminado');
        }

        return redirect()->route('posts.index')->with('error', 'No has dado like a esta publicación previamente');
    }
}
