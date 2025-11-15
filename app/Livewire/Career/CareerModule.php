<?php

namespace App\Livewire\Career;

use App\Models\CareerApplication;
use App\Models\CareerVacancy;
use Livewire\Component;

class CareerModule extends Component
{
    public ?int $selectedVacancyId = null;

    public array $form = [
        'name' => '',
        'email' => '',
        'phone' => '',
        'current_position' => '',
        'resume_url' => '',
        'cover_letter' => '',
    ];

    public function mount(?int $vacancyId = null): void
    {
        $this->selectedVacancyId = $vacancyId;
    }

    public function render()
    {
        $vacancies = CareerVacancy::query()
            ->active()
            ->get();

        if ($vacancies->isNotEmpty() && ! $vacancies->contains('id', $this->selectedVacancyId)) {
            $this->selectedVacancyId = $vacancies->first()->id;
        }

        $selectedVacancy = $vacancies->firstWhere('id', $this->selectedVacancyId);

        return view('livewire.career.career-module', [
            'vacancies' => $vacancies,
            'selectedVacancy' => $selectedVacancy,
        ]);
    }

    public function selectVacancy(int $vacancyId): void
    {
        $vacancyId = (int) $vacancyId;

        $vacancyExists = CareerVacancy::query()
            ->active()
            ->whereKey($vacancyId)
            ->exists();

        if ($vacancyExists) {
            $this->selectedVacancyId = $vacancyId;
        }
    }

    protected function rules(): array
    {
        return [
            'selectedVacancyId' => ['required', 'integer', 'exists:career_vacancies,id'],
            'form.name' => ['required', 'string', 'max:255'],
            'form.email' => ['required', 'email', 'max:255'],
            'form.phone' => ['nullable', 'string', 'max:50'],
            'form.current_position' => ['nullable', 'string', 'max:255'],
            'form.resume_url' => ['nullable', 'url', 'max:255'],
            'form.cover_letter' => ['nullable', 'string'],
        ];
    }

    public function submit(): void
    {
        $validated = $this->validate();

        $this->selectedVacancyId = (int) $validated['selectedVacancyId'];

        $vacancy = CareerVacancy::query()
            ->where('is_active', true)
            ->findOrFail($this->selectedVacancyId);

        CareerApplication::create([
            'career_vacancy_id' => $vacancy->getKey(),
            'name' => $validated['form']['name'],
            'email' => $validated['form']['email'],
            'phone' => $validated['form']['phone'] ?? null,
            'current_position' => $validated['form']['current_position'] ?? null,
            'resume_url' => $validated['form']['resume_url'] ?? null,
            'cover_letter' => $validated['form']['cover_letter'] ?? null,
            'ip_address' => request()->ip(),
            'submitted_at' => now(),
        ]);

        $this->form = [
            'name' => '',
            'email' => '',
            'phone' => '',
            'current_position' => '',
            'resume_url' => '',
            'cover_letter' => '',
        ];

        session()->flash('career_success', __('Thank you! Your application has been received.'));

        $this->dispatch('career-application-submitted');
    }
}
