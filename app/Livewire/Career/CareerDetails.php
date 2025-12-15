<?php

namespace App\Livewire\Career;

use App\Models\CareerApplication;
use App\Models\CareerVacancy;
use App\Models\Page;
use Livewire\Component;
use Livewire\WithFileUploads;

class CareerDetails extends Component
{
    use WithFileUploads;

    public $page;
    public CareerVacancy $vacancy;

    public array $form = [
        'name' => '',
        'email' => '',
        'phone' => '',
        'current_position' => '',
        'resume_file' => null,
        'cover_letter' => '',
    ];

    public function mount($slug)
    {
        $this->vacancy = CareerVacancy::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Try to get the careers page for the sidebar menu
        $careersPage = Page::where('slug', 'careers')->first();

        $this->page = (object) [
            'title' => $this->vacancy->title,
            'slug' => $careersPage?->slug ?? 'careers',
            'id' => $careersPage?->id,
            'parent_id' => $careersPage?->parent_id,
        ];
    }

    public function render()
    {
        return view('livewire.pages.career-details-page');
    }

    protected function rules(): array
    {
        return [
            'form.name' => ['required', 'string', 'max:255'],
            'form.email' => ['required', 'email', 'max:255'],
            'form.phone' => ['nullable', 'string', 'max:50'],
            'form.current_position' => ['nullable', 'string', 'max:255'],
            'form.resume_file' => ['nullable', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png,gif', 'max:10240'],
            'form.cover_letter' => ['nullable', 'string'],
        ];
    }

    public function submit(): void
    {
        $validated = $this->validate();

        // Handle file upload
        $resumePath = null;
        if (!empty($validated['form']['resume_file'])) {
            $resumePath = $validated['form']['resume_file']->store('resumes', 'public');
        }

        CareerApplication::create([
            'career_vacancy_id' => $this->vacancy->getKey(),
            'name' => $validated['form']['name'],
            'email' => $validated['form']['email'],
            'phone' => $validated['form']['phone'] ?? null,
            'current_position' => $validated['form']['current_position'] ?? null,
            'resume_url' => $resumePath,
            'cover_letter' => $validated['form']['cover_letter'] ?? null,
            'ip_address' => request()->ip(),
            'submitted_at' => now(),
        ]);

        $this->form = [
            'name' => '',
            'email' => '',
            'phone' => '',
            'current_position' => '',
            'resume_file' => null,
            'cover_letter' => '',
        ];

        session()->flash('career_success', __('Thank you! Your application has been received.'));

        $this->dispatch('career-application-submitted');
    }
}
