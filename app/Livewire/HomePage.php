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

        $appointment = Appointment::create([
            'doctor_id' => $this->doctor->id ?? 1,
            'appointment_date' => Carbon::parse($validated['appointment_date'])->format('Y-m-d'),
            'patient_name' => $validated['patient_name'],
            'patient_email' => $validated['patient_email'],
            'patient_phone' => $validated['patient_phone'],
            'message' => $validated['message'] ?? null,
        ]);

        $recipient = config('mail.contact_recipient', config('mail.from.address'));

        if (! empty($recipient)) {
            Mail::to($recipient)->send(new NewAppointmentNotification($appointment));
        }

        $this->form = [
            'appointment_date' => '',
            'patient_name' => '',
            'patient_email' => '',
            'patient_phone' => '',
            'message' => '',
        ];

        session()->flash('appointment_success', __('Your appointment request has been sent successfully.'));

        $this->dispatch('appointment-created');
    }
}
