<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\File;
use App\Models\User;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Models\Visibility;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\FileController;

class PlaceController extends Controller
{
    /**
     * Constructor del controlador.
     */
    public function __construct()
    {
        $this->authorizeResource(Place::class, 'place');
    }

    /**
     * Muestra una lista de los recursos.
     */
    public function index()
    {
        return view("places.index", [
            "places" => Place::with('visibility')->paginate(5),
        ]);
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     */
    public function create()
    {
        $visibilities = Visibility::all();
        return view("places.create", compact('visibilities'));
    }

    /**
     * Almacena un recurso recién creado en el almacenamiento.
     */
    public function store(Request $request)
    {
        try {
            // Validación de los datos de entrada.
            $validatedData = $request->validate([
                'title'         => 'required|max:30',
                'latitude'      => 'required|max:9',
                'longitude'     => 'required|max:9',
                'descripcion'   => 'required|max:200',
                'upload'        => 'required|mimes:gif,jpeg,jpg,png|max:1024',
                'visibility_id' => 'required|exists:visibilities,id',
            ]);

            // Obtención de los datos del formulario.
            $title       = $request->get('title');
            $latitude    = $request->get('latitude');
            $longitude   = $request->get('longitude');
            $description = $request->get('descripcion');
            $upload      = $request->file('upload');
            $fileName    = $upload->getClientOriginalName();
            $fileSize    = $upload->getSize();

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

                // Creación del lugar en la base de datos.
                $place = Place::create([
                    'title'         => $title,
                    'latitude'      => $latitude,
                    'longitude'     => $longitude,
                    'descripcion'   => $description,
                    'file_id'       => $file->id,
                    'author_id'     => auth()->user()->id,
                    'visibility_id' => $request->visibility_id,
                ]);

                return redirect()->route('places.show', $place)->with('success', 'El lugar se ha creado correctamente.');
            } else {
                \Log::debug("Disk storage FAILS");
                return redirect()->route("places.create")->with('error', 'No se ha podido subir la imagen.');
            }
        } catch (\Exception $e) {
            \Log::error("Error storing place: " . $e->getMessage());
            return redirect()->route("places.create")->with('error', 'No se ha podido crear el lugar');
        }
    }

    /**
     * Muestra el recurso especificado.
     */
    public function show(Place $place)
    {
        $fileExists = Storage::disk('public')->exists($place->file->filepath);

        if (!$fileExists) {
            return redirect()->route('places.index')->with('error', 'Archivo no encontrado');
        }

        if (!$place->id) {
            return redirect()->route('places.index')->with('error', 'Publicación no encontrada');
        }

        return view('places.show', compact('place'));
    }

    /** 
     * Muestra el formulario para editar el recurso especificado.
     */
    public function edit(place $place)
    {
        $visibilities = Visibility::all();
        return view('places.edit', compact('visibilities', 'place'));
    }

    /**
     * Eliminar el recurso especificado del almacenamiento.
     */
    public function destroy(Place $place)
    {
        // Eliminar el archivo asociado al place.
        Storage::disk('public')->delete($place->file->filepath);

        // Eliminar la entrada del place y la entrada del archivo en la base de datos.
        $place->delete();
        $place->file->delete();

        return redirect()->route('places.index')->with('success', 'Lugar eliminado con éxito');
    }

    /**
     * Realiza una búsqueda de recursos basada en un término de búsqueda.
     */
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $places = Place::where('title', 'like', '%' . $searchTerm . '%')->paginate(5);

        return view('places.index', ['places' => $places]);
    }


    /**
     * Marca un lugar como favorito para el usuario autenticado.
     */
    public function favorite(Place $place)
    {
        $user = auth()->user();

        if (!$user->favorites->contains($place->id)) {
            $user->favorites()->attach($place);
        }

        return redirect()->route('places.index');
    }

    /**
     * Desmarca un lugar como favorito para el usuario autenticado.
     */
    public function unfavorite(Place $place)
    {
        $user = auth()->user();

        if ($user->favorites->contains($place->id)) {
            $user->favorites()->detach($place);
        }

        return redirect()->route('places.index');
    }
}
