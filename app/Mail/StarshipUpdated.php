<?php

namespace App\Mail;

use App\Models\Starship;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StarshipUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $starship;

    /**
     * Create a new message instance.
     *
     * @param  Starship  $starship
     * @return void
     */
    public function __construct(Starship $starship)
    {
        $this->starship = $starship;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Starship Updated',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return (new Content())
            ->view('emails.starship-updated')
            ->with(['starship' => $this->starship]);
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
