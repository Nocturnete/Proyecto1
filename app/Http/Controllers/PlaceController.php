<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\File;
use App\Models\User;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\FileController;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("places.index", [
            "places" => Place::paginate(5),
            // "files" => File::all(),
            // "users" => User::all(),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("places.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar fitxer
        $validatedData = $request->validate([
            'title'       => 'required',
            'latitude'    => 'required',
            'longitude'   => 'required',
            'descripcion' => 'required',
            'upload'      => 'required|mimes:gif,jpeg,jpg,png|max:1024',
        ]);
        
        // DATOS DEL FORM      
        $title        = $request->get('title');        
        $latitude    = $request->get('latitude');
        $longitude   = $request->get('longitude');
        $description = $request->get('descripcion');
        $upload = $request->file('upload');
        $fileName = $upload->getClientOriginalName();
        $fileSize = $upload->getSize();
        \Log::debug("Storing file '{$fileName}' ($fileSize)...");
    
        // Pujar fitxer al disc dur
        $uploadName = time() . '_' . $fileName;
        $filePath = $upload->storeAs(
            'uploads',      // Path
            $uploadName ,   // Filename
            'public'        // Disk
        );
        if (\Storage::disk('public')->exists($filePath)) {
            \Log::debug("Disk storage OK");
            $fullPath = \Storage::disk('public')->path($filePath);
            \Log::debug("File saved at {$fullPath}");
            // Desar dades a BD
            $file = File::create([
                'filepath' => $filePath,
                'filesize' => $fileSize,
            ]);
            \Log::debug("DB storage OK");
            $place = Place::create([
                'title'       => $request->title,
                'latitude'    => $latitude,
                'longitude'   => $longitude,
                'descripcion' => $request->descripcion,
                'file_id'     => $file->id,
                'author_id'   => auth()->user()->id,
            ]);
            return redirect()->route('places.show', $place)
                ->with('success', 'File successfully saved');
        } else {
            \Log::debug("Disk storage FAILS");
            return redirect()->route("places.create")
                ->with('error', 'ERROR uploading file');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Place $place)
    {
        return view("places.show", [
            'place'  => $place,
            'file'   => $place->file,
            'author' => $place->user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Place $place)
    {
        return view("places.edit", [
            'place'  => $place,
            'file'   => $place->file,
            'author' => $place->user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Place $place)
    {
        // Validar fitxer
        $request->validate([
            'title' => 'required|max:25',
            'latitude'    => 'required',
            'longitude'   => 'required',
            'descripcion' => 'required|max:250',
            'upload' => 'required|mimes:gif,jpeg,jpg,png|max:1024',
        ]);
        
        // Obtenir dades del fitxer
        if ($request->hasFile('upload')) {
            Storage::disk('public')->delete($place->file->filepath);
            
            $newFile = $request->file('upload');
            $newFileName = time() . '_' . $newFile->getClientOriginalName();
            $newFilePath = $newFile->storeAs('uploads', $newFileName, 'public');
    
            // Actualiza la información del archivo en la base de datos
            $place->file->update([
                'original_name' => $newFile->getClientOriginalName(),
                'filesize' => $newFile->getSize(),
                'filepath' => $newFilePath,
            ]);
        }
        $place->update([
            'title' => $request->title,
            'coordenadas' => $request->coordenadas,
            'descripcion' => $request->descripcion,
            'file_id' => $place->file->id,
        ]);
        return redirect()->route('places.show', $place)->with('success', 'File successfully saved');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {
        Storage::disk('public')->delete($place->file->filepath);
        $place->delete();
        $place->file->delete();
        return redirect()->route('places.index')->with('success', 'Archivo eliminado con éxito');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $places = Place::where('title', 'like', '%'. $searchTerm . '%')->paginate(5);
        return view('places.index', ['places' => $places]);
    }

    public function favorite(Place $place)
    {
        $user = auth()->user();
    
        if (!$user->favorites->contains($place->id)) {
            $user->favorites()->attach($place);
            return redirect()->route('places.index');
        }
    
        return redirect()->route('places.index');
    }
    
    public function unfavorite(Place $place)
    {
        $user = auth()->user();
    
        if ($user->favorites->contains($place->id)) {
            $user->favorites()->detach($place);
            return redirect()->route('places.index');
        }
    
        return redirect()->route('places.index');
    }
}
