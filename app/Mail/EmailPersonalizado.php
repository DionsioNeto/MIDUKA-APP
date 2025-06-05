<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailPersonalizado extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;
    public $mensagem;

    public function __construct($usuario, $mensagem)
    {
        $this->usuario = $usuario;
        $this->mensagem = $mensagem;
    }

    public function build()
    {
        return $this->subject('Mensagem do formulário de contato')
                    ->view('emails.personalizado');
    }
    
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Email Personalizado',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
