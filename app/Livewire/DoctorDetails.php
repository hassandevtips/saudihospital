<?php

namespace App\Livewire;

use App\Mail\NewAppointmentNotification;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class DoctorDetails extends Component
{
    public $page;
    public Doctor $doctor;
    public array $form = [
        'appointment_date' => '',
        'patient_name' => '',
        'patient_email' => '',
        'patient_phone' => '',
        'message' => '',
    ];

    public function mount(Doctor $doctor): void
    {
        $this->page = (object) [
            'title' => $doctor->name . ' Details',
        ];

        $this->doctor = $doctor;
    }

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

    public function submitAppointment(): void
    {
        $validated = $this->validate()['form'];

        $appointment = Appointment::create([
            'doctor_id' => $this->doctor->id,
            'appointment_date' => $validated['appointment_date'],
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

    public function render()
    {
        return view('livewire.pages.doctor-single-template', [
            'page' => $this->page,
            'doctor' => $this->doctor,
        ]);
    }
}
