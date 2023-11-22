<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class MailController extends Controller
{
    /**
     * 
     * Envía un correo de prueba.
     * 
     */
    public function test(Request $request)
    {
        try {
            // Creación de una nueva instancia de TestMail con los datos proporcionados.
            $mail = new TestMail([
                'name' => 'Anonymous',
                'body' => 'Testing mail',
                'url'  => '/'
            ]);

            // Envío del correo electrónico a la dirección especificada.
            Mail::to('jmir-laravel@mailinator.com')->send($mail);

            // Respuesta exitosa si el correo electrónico se envió correctamente.
            echo '<h1>Mail send successfully</h1>';
        } catch (\Exception $e) {
            // Respuesta de error en caso de cualquier excepción.
            echo '<pre>Error - ' . $e .'</pre>';
        }
    }
}
