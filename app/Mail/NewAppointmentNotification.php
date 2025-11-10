<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewAppointmentNotification extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public Appointment $appointment)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Appointment Request',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.appointments.new',
            with: [
                'appointment' => $this->appointment->loadMissing('doctor'),
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
