<?php

namespace App\Livewire;

use App\Mail\ContactMessageSubmitted;
use App\Models\ContactSubmission;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactForm extends Component
{
    public array $form = [
        'name' => '',
        'email' => '',
        'phone' => '',
        'subject' => '',
        'message' => '',
    ];

    public function render()
    {
        return view('livewire.contact-form');
    }

    protected function rules(): array
    {
        return [
            'form.name' => ['required', 'string', 'max:255'],
            'form.email' => ['required', 'email', 'max:255'],
            'form.phone' => ['nullable', 'string', 'max:50'],
            'form.subject' => ['nullable', 'string', 'max:255'],
            'form.message' => ['nullable', 'string'],
        ];
    }

    public function submit(): void
    {
        $validated = $this->validate()['form'];

        $submission = ContactSubmission::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'subject' => $validated['subject'] ?? null,
            'message' => $validated['message'] ?? null,
            'ip_address' => request()->ip(),
        ]);

        $recipient = config('mail.contact_recipient', config('mail.from.address'));

        if (empty($recipient)) {
            $recipientSetting = SiteSetting::get('email');

            if (is_array($recipientSetting)) {
                $recipient = $recipientSetting[app()->getLocale()] ?? reset($recipientSetting);
            } else {
                $recipient = $recipientSetting;
            }
        }

        if (! empty($recipient)) {
            Mail::to($recipient)->send(new ContactMessageSubmitted($submission));
        }

        $this->form = [
            'name' => '',
            'email' => '',
            'phone' => '',
            'subject' => '',
            'message' => '',
        ];

        session()->flash('contact_success', __('Thank you! Your message has been sent successfully.'));

        $this->dispatch('contact-submitted');
    }
}
