<?php

namespace App\Livewire;

use App\Mail\NewAppointmentNotification;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Support\Facades\Log;
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
    public $currentStep = 1;
    public $showModal = false;

    public function mount(Doctor $doctor): void
    {
        $this->page = (object) [
            'title' => $doctor->name . ' ' . gt('details', 'Details'),
            'banner_image_url' => $doctor->banner_image_url,
        ];

        $this->doctor = $doctor->load(['department', 'location']);
    }

    public function openModal(): void
    {
        $this->showModal = true;
        $this->currentStep = 1;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->currentStep = 1;
    }

    public function nextStep(): void
    {
        $this->validateStep();

        if ($this->currentStep < 4) {
            $this->currentStep++;
        }
    }

    public function prevStep(): void
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function validateStep(): void
    {
        if ($this->currentStep === 1) {
            $this->validate([
                'form.appointment_date' => ['required', 'date', 'after_or_equal:today'],
            ]);
        } elseif ($this->currentStep === 2) {
            $this->validate([
                'form.appointment_time' => ['required', 'string'],
            ]);
        } elseif ($this->currentStep === 3) {
            $this->validate([
                'form.patient_name' => ['required', 'string', 'max:255'],
                'form.patient_email' => ['required', 'string', 'email', 'max:255'],
                'form.patient_phone' => ['required', 'string', 'max:32'],
                'form.message' => ['nullable', 'string'],
            ]);
        }
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

    public function canProceedToNextStep(): bool
    {
        if ($this->currentStep === 1) {
            return !empty($this->form['appointment_date']);
        } elseif ($this->currentStep === 2) {
            return !empty($this->form['appointment_time']) && $this->isDoctorAvailable && !empty($this->availableSlots);
        } elseif ($this->currentStep === 3) {
            return !empty($this->form['patient_name']) &&
                !empty($this->form['patient_email']) &&
                !empty($this->form['patient_phone']);
        }
        return true;
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

        try {
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
                try {
                    Mail::to($recipient)->send(new NewAppointmentNotification($appointment));
                } catch (\Exception $e) {
                    // Log email error but don't fail the appointment
                    Log::error('Failed to send appointment notification email: ' . $e->getMessage());
                }
            }

            // Reset form
            $this->reset(['form', 'availableSlots']);
            $this->isDoctorAvailable = true;
            $this->currentStep = 1;
            $this->showModal = false;

            session()->flash('appointment_success', __('Your appointment has been booked successfully. We will contact you shortly to confirm.'));

            $this->dispatch('appointment-created');
        } catch (\Exception $e) {
            session()->flash('appointment_error', __('An error occurred while booking your appointment. Please try again.'));
            Log::error('Appointment booking error: ' . $e->getMessage());
        }
    }

    public function resetForm(): void
    {
        $this->reset(['form', 'availableSlots']);
        $this->isDoctorAvailable = true;
    }

    public function render()
    {
        return view('livewire.pages.doctor-single-template', [
            'page' => $this->page,
            'doctor' => $this->doctor,
        ]);
    }
}
