<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * 
     * Crea una nueva instancia del controlador.
     * 
     */
    public function __construct()
    {
        // Se aplica la autorización de recursos para el modelo File.
        $this->authorizeResource(File::class, 'file');
    }

    /**
     * 
     * Muestra una lista de los recursos.
     * 
     */
    public function index()
    {
        return view("files.index", [
            "files" => File::all()
        ]);
    }
    /**
     * 
     * Muestra el formulario para crear un nuevo recurso.
     * 
     */
    public function create()
    {
        return view("files.create");
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
            'upload' => 'required|mimes:gif,jpeg,jpg,png|max:2048'
        ]);

        // Procesamiento y almacenamiento del archivo.
        $upload = $request->file('upload');
        $fileName = $upload->getClientOriginalName();
        $fileSize = $upload->getSize();
        \Log::debug("Storing file '{$fileName}' ($fileSize)...");

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

            // Creación de la entrada en la base de datos.
            $file = File::create([
                'filepath' => $filePath,
                'filesize' => $fileSize,
            ]);

            \Log::debug("DB storage OK");
            return redirect()->route('files.show', $file)
                ->with('success', 'File successfully saved');
        } else {
            \Log::debug("Disk storage FAILS");
            return redirect()->route("files.create")
                ->with('error', 'ERROR uploading file');
        }
    }

    /**
     * 
     * Muestra el recurso especificado.
     * 
     */
    public function show(File $file)
    {
        return view("files.show", [
            'file' => $file
        ]);
    }

    /**
     * 
     * Muestra el formulario para editar el recurso especificado.
     * 
     */
    public function edit(File $file)
    {
        return view('files.edit', compact('file'));
    }

    /**
     * 
     * Actualiza el recurso especificado en el almacenamiento.
     * 
     */
    public function update(Request $request, File $file)
    {
        // Validación de los datos de entrada.
        $request->validate([
            'upload' => 'required|mimes:gif,jpeg,jpg,png|max:2048'
        ]);

        // Actualización del archivo y sus detalles en la base de datos.
        if ($request->hasFile('upload')) {
            Storage::disk('public')->delete($file->filepath);

            $newFile = $request->file('upload');
            $newFileName = time() . '_' . $newFile->getClientOriginalName();
            $newFilePath = $newFile->storeAs('uploads', $newFileName, 'public');

            $file->update([
                'original_name' => $newFile->getClientOriginalName(),
                'filesize' => $newFile->getSize(),
                'filepath' => $newFilePath,
            ]);
        }
        return redirect()->route('files.show', $file)->with('success', 'Archivo actualizado con éxito');
    }

    /**
     * 
     * Elimina el recurso especificado del almacenamiento.
     * 
     */
    public function destroy(File $file)
    {
        // Eliminación del archivo y su entrada en la base de datos.
        Storage::disk('public')->delete($file->filepath);
        $file->delete();

        return redirect()->route('files.index')->with('success', 'Archivo eliminado con éxito');
    }
}
