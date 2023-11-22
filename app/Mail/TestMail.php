<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * 
     * Los datos del contenido del correo electrónico.
     *
     */
    protected $content;

    /**
     * 
     * Crea una nueva instancia del mensaje.
     *
     */
    public function __construct(array $content)
    {
        $this->content = $content;
    }

    /**
     * 
     * Obtiene el sobre del mensaje.
     *
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Test Mail',
        );
    }

    /**
     * 
     * Obtiene la definición del contenido del mensaje.
     *
     */
    public function content()
    {
        return new Content(
            markdown: 'mails.testmail',
            with: [
                'content' => $this->content,
            ],
        );
    }

    /**
     * 
     * Obtiene los adjuntos para el mensaje.
     *
     */
    public function attachments(): array
    {
        return [];
    }
}
