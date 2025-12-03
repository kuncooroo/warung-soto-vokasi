<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public ContactMessage $message)
    {
    }

    public function envelope()
    {
        return new \Illuminate\Mail\Mailables\Envelope(
            subject: 'Pesan Baru - ' . $this->message->subject,
        );
    }

    public function content()
    {
        return new \Illuminate\Mail\Mailables\Content(
            view: 'emails.contact-notification',
            with: [
                'contact' => $this->message,
            ],
        );
    }
}