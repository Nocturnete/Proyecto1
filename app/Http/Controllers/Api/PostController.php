<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\File;
use App\Models\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::all();

        if ($posts) {
            return response()->json([
                'success' => true,
                'data' => $posts
            ], 200);
        } else {
            return response()->json([
                'success'  => false,
                'message' => 'Error list posts'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'title' => 'required|max:20',
            'description' => 'required|max:200',
            'upload' => 'required|mimes:gif,jpeg,jpg,png|max:1024',
            'visibility_id' => 'required|exists:visibilities,id', 
        ]);
        
        // Obtención de los datos del formulario.
        $upload = $request->file('upload');
        $fileName = $upload->getClientOriginalName();
        $fileSize = $upload->getSize();

        // Almacenamiento del archivo en el sistema de archivos y la base de datos.
        $uploadName = time() . '_' . $fileName;
        $filePath = $upload->storeAs(
            'uploads',
            $uploadName,
            'public'
        );

        if (\Storage::disk('public')->exists($filePath)) {

            $fullPath = \Storage::disk('public')->path($filePath);

            // Creación de la entrada del archivo en la base de datos.
            $file = File::create([
                'filepath' => $filePath,
                'filesize' => $fileSize,
            ]);

            // Creación de la publicación en la base de datos.
            $post = Post::create([
                'author_id' => auth()->user()->id,
                'file_id' => $file->id,
                'title' => $request->title,
                'description' => $request->description,
                'visibility_id' => $request->visibility_id
            ]);
            
            return response()->json([
                'success' => true,
                'data'    => $post
            ], 201);

        } else {
            return response()->json([
                'success'  => false,
                'message' => 'Error uploading post'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);

        if ($post) {
            return response()->json([
                'success' => true,
                'data' => $post
            ], 200);
        } else {
            return response()->json([
                'success'  => false,
                'message' => 'Error show post'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $post = Post::find($id);
        if ($post) {
            $validatedData = $request->validate([
                'title' => 'required|max:20',
                'description' => 'required|max:200',
                'upload' => 'required|mimes:gif,jpeg,jpg,png|max:1024',
                'visibility_id' => 'required|exists:visibilities,id', 
            ]);

            if ($request->hasFile('upload')) {
                \Storage::disk('public')->delete($post->file->filepath);
    
                $newFile = $request->file('upload');
                $newFileName = time() . '_' . $newFile->getClientOriginalName();
                $newFilePath = $newFile->storeAs('uploads', $newFileName, 'public');
    
                $post->file->update([
                    'original_name' => $newFile->getClientOriginalName(),
                    'filesize' => $newFile->getSize(),
                    'filepath' => $newFilePath,
                ]);
            }

            $post->update([
                'author_id' => auth()->user()->id,
                'file_id' => $post->file->id,
                'title' => $request->title,
                'description' => $request->description,
                'visibility_id' => $request->visibility_id,
            ]);

            if ($post) {
                return response()->json([
                    'success' => true,
                    'data'    => $post
                ], 200);
            } else {
                return response()->json([
                    'success'  => false,
                    'message' => 'Error updating post'
                ], 500);
            }
        } else {
            return response()->json([
                'success'  => false,
                'message' => 'Post not found'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $post = Post::find($id);
        if ($post) {
            $post->delete();

            return response()->json([
                'success' => true,
                'data' => $post
            ], 200);
        } else {
            return response()->json([
                'success'  => false,
                'message' => 'Post not found'
            ], 404);
        }
    }

    public function like(string $id)
    {
        $post = Post::find($id);
        $user = auth()->user();
        dd($user);
        if ($post) {
            return response()->json([
                'success' => true,
                'data'    => $post
            ], 200);
        }

        return response()->json([
            'success'  => false,
            'message' => 'Error like post'
        ], 500);
    }

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

    public function update_workaround(Request $request, $id)
    {
        return $this->update($request, $id);
    }
}
