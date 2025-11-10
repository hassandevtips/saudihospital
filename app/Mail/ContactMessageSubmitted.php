<?php

namespace App\Mail;

use App\Models\ContactSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessageSubmitted extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public ContactSubmission $submission)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('New Contact Message'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact.new',
            with: [
                'submission' => $this->submission,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
