<?php

namespace App\Livewire;

use App\Models\SiteSetting;
use Livewire\Component;

class ContactForm extends Component
{
    public $name = '';
    public $email = '';
    public $date = '';
    public $phone;

    public function mount()
    {
        $this->phone = SiteSetting::get('phone', '0096265564414');
    }

    public function submitAppointment()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'date' => 'required',
        ]);

        // Here you can add logic to save the appointment
        // For now, just show a success message
        session()->flash('message', 'Appointment request sent successfully!');

        $this->reset(['name', 'email', 'date']);
    }

    public function render()
    {
        return view('livewire.components.contact-form');
    }
}
