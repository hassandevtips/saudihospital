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
        'appointment_time' => '',
        'patient_name' => '',
        'patient_email' => '',
        'patient_phone' => '',
        'message' => '',
    ];

    public $availableSlots = [];
    public $isDoctorAvailable = true;

    public function mount(Doctor $doctor): void
    {
        $this->page = (object) [
            'title' => $doctor->name . ' Details',
        ];

        $this->doctor = $doctor;
    }

    public function updatedFormAppointmentDate($value): void
    {
        if (empty($value)) {
            $this->availableSlots = [];
            $this->isDoctorAvailable = true;
            $this->form['appointment_time'] = '';
            return;
        }

        // Check if doctor is available on this date
        $this->isDoctorAvailable = $this->doctor->isAvailableOnDate($value);

        if ($this->isDoctorAvailable) {
            $this->availableSlots = $this->doctor->getAvailableSlots($value);

            // If no slots available, mark as unavailable
            if (empty($this->availableSlots)) {
                $this->isDoctorAvailable = false;
            }
        } else {
            $this->availableSlots = [];
        }

        // Reset selected time
        $this->form['appointment_time'] = '';
    }

    protected function rules(): array
    {
        return [
            'form.appointment_date' => ['required', 'date', 'after_or_equal:today'],
            'form.appointment_time' => ['required', 'string'],
            'form.patient_name' => ['required', 'string', 'max:255'],
            'form.patient_email' => ['required', 'string', 'email', 'max:255'],
            'form.patient_phone' => ['required', 'string', 'max:32'],
            'form.message' => ['nullable', 'string'],
        ];
    }

    public function submitAppointment(): void
    {
        $validated = $this->validate()['form'];

        // Double check if slot is still available
        $availableSlots = $this->doctor->getAvailableSlots($validated['appointment_date']);
        if (!in_array($validated['appointment_time'], $availableSlots)) {
            session()->flash('appointment_error', __('Sorry, this time slot is no longer available. Please select another slot.'));
            $this->updatedFormAppointmentDate($validated['appointment_date']);
            return;
        }

        $appointment = Appointment::create([
            'doctor_id' => $this->doctor->id,
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => $validated['appointment_time'],
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
            'appointment_time' => '',
            'patient_name' => '',
            'patient_email' => '',
            'patient_phone' => '',
            'message' => '',
        ];

        $this->availableSlots = [];
        $this->isDoctorAvailable = true;

        session()->flash('appointment_success', __('Your appointment has been booked successfully.'));

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
