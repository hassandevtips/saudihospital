<?php

namespace App\Livewire\Career;

use App\Models\CareerVacancy;
use Livewire\Component;

class CareerList extends Component
{
    public function render()
    {
        $vacancies = CareerVacancy::query()
            ->active()
            ->get();

        return view('livewire.career.career-list', [
            'vacancies' => $vacancies,
        ]);
    }
}
