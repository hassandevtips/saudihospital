<?php

namespace App\Livewire;

use App\Models\HomePageContent;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewAppointmentNotification;
use App\Models\Appointment;
use Carbon\Carbon;

class HomePage extends Component
{

    public array $form = [
        'appointment_date' => '',
        'patient_name' => '',
        'patient_email' => '',
        'patient_phone' => '',
        'message' => '',
    ];


    protected function rules(): array
    {
        return [
            'form.appointment_date' => ['required', 'date', 'after_or_equal:today'],
            'form.patient_name' => ['required', 'string', 'max:255'],
            'form.patient_email' => ['required', 'string', 'email', 'max:255'],
            'form.patient_phone' => ['required', 'string', 'max:32'],
            'form.message' => ['nullable', 'string'],
        ];
    }

    public function render()
    {
        $content = HomePageContent::getContent();

        return view('livewire.pages.home-page', [
            'content' => $content,
            'isHomePage' => true,
        ]);
    }

    public function submitAppointment(): void
    {
        $validated = $this->validate()['form'];

        // Get WhatsApp number from site settings
        $whatsappNumber = \App\Models\SiteSetting::get('whatsapp_number', '0096265564414');

        // Clean the WhatsApp number (remove spaces, dashes, etc.)
        $cleanNumber = preg_replace('/[^0-9]/', '', $whatsappNumber);

        // Build WhatsApp message
        $message = "Hello, I would like to book an appointment:\n\n";
        $message .= "Name: " . $validated['patient_name'] . "\n";
        $message .= "Email: " . $validated['patient_email'] . "\n";
        $message .= "Phone: " . $validated['patient_phone'] . "\n";
        $message .= "Preferred Date: " . $validated['appointment_date'] . "\n";

        if (!empty($validated['message'])) {
            $message .= "Message: " . $validated['message'] . "\n";
        }

        // URL encode the message
        $encodedMessage = urlencode($message);

        // Create WhatsApp URL
        $whatsappUrl = "https://wa.me/{$cleanNumber}?text={$encodedMessage}";

        // Redirect to WhatsApp
        $this->dispatch('redirect-to-whatsapp', url: $whatsappUrl);
    }
}
