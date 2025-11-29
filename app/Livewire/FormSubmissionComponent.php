<?php

namespace App\Livewire;

use App\Models\FormSubmission;
use App\Models\Page;
use Livewire\Component;

class FormSubmissionComponent extends Component
{
    public $page;
    public string $formType = 'internship'; // Default type

    public array $form = [
        'name' => '',
        'email' => '',
        'phone' => '',
        'national_id' => '',
        'date_of_birth' => '',
        'education_level' => '',
        'university' => '',
        'major' => '',
        'current_position' => '',
        'resume_url' => '',
        'cover_letter' => '',
        'message' => '',
    ];

    public function mount($type = 'internship')
    {
        $this->formType = $type;

        // Try to get the page for the sidebar menu
        $formPage = Page::where('slug', $type)->first();

        $this->page = (object) [
            'title' => $formPage?->title,
            'slug' => $formPage?->slug ?? $type,
            'id' => $formPage?->id,
            'parent_id' => $formPage?->parent_id,
            'banner_image_url' => $formPage?->banner_image_url,
        ];
    }

    public function render()
    {
        return view('livewire.form-submission-component', [
            'formTypes' => FormSubmission::getTypes(),
            'educationLevels' => $this->getEducationLevels(),
        ]);
    }

    protected function getFormTitle(): string
    {
        $types = FormSubmission::getTypes();
        return $types[$this->formType] ?? 'Form Submission';
    }

    protected function getEducationLevels(): array
    {
        return [
            'high_school' => gt('high_school', 'High School'),
            'diploma' => gt('diploma', 'Diploma'),
            'bachelor' => gt('bachelor', 'Bachelor\'s Degree'),
            'master' => gt('master', 'Master\'s Degree'),
            'phd' => gt('phd', 'PhD'),
            'other' => gt('other', 'Other'),
        ];
    }

    protected function rules(): array
    {
        return [
            'form.name' => ['required', 'string', 'max:255'],
            'form.email' => ['required', 'email', 'max:255'],
            'form.phone' => ['nullable', 'string', 'max:50'],
            'form.national_id' => ['nullable', 'string', 'max:50'],
            'form.date_of_birth' => ['nullable', 'date', 'before:' . now()->subYears(15)->format('Y-m-d')],
            'form.education_level' => ['nullable', 'string'],
            'form.university' => ['nullable', 'string', 'max:255'],
            'form.major' => ['nullable', 'string', 'max:255'],
            'form.current_position' => ['nullable', 'string', 'max:255'],
            'form.resume_url' => ['nullable', 'url', 'max:255'],
            'form.cover_letter' => ['nullable', 'string'],
            'form.message' => ['nullable', 'string'],
        ];
    }

    protected function messages(): array
    {
        return [
            'form.name.required' => __('Please enter your full name.'),
            'form.email.required' => __('Please enter your email address.'),
            'form.email.email' => __('Please enter a valid email address.'),
            'form.date_of_birth.before' => __('You must be at least 15 years old.'),
            'form.resume_url.url' => __('Please enter a valid URL.'),
        ];
    }

    public function submit(): void
    {
        $validated = $this->validate();

        FormSubmission::create([
            'type' => $this->formType,
            'name' => $validated['form']['name'],
            'email' => $validated['form']['email'],
            'phone' => $validated['form']['phone'] ?? null,
            'national_id' => $validated['form']['national_id'] ?? null,
            'date_of_birth' => $validated['form']['date_of_birth'] ?? null,
            'education_level' => $validated['form']['education_level'] ?? null,
            'university' => $validated['form']['university'] ?? null,
            'major' => $validated['form']['major'] ?? null,
            'current_position' => $validated['form']['current_position'] ?? null,
            'resume_url' => $validated['form']['resume_url'] ?? null,
            'cover_letter' => $validated['form']['cover_letter'] ?? null,
            'message' => $validated['form']['message'] ?? null,
            'status' => 'pending',
            'ip_address' => request()->ip(),
            'submitted_at' => now(),
        ]);

        $this->form = [
            'name' => '',
            'email' => '',
            'phone' => '',
            'national_id' => '',
            'date_of_birth' => '',
            'education_level' => '',
            'university' => '',
            'major' => '',
            'current_position' => '',
            'resume_url' => '',
            'cover_letter' => '',
            'message' => '',
        ];

        session()->flash('form_success', __('Thank you! Your application has been received successfully.'));

        $this->dispatch('form-submission-submitted');
    }
}
