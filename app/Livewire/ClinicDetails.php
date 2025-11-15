<?php

namespace App\Livewire;

use App\Models\Clinic;
use App\Models\Page;
use Livewire\Component;

class ClinicDetails extends Component
{
    public $clinic;
    public $slug;
    public $page;
    public $clinics;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->clinic = Clinic::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $this->page = Page::where('slug', 'specialty-clinics')->first();
        $this->clinics = Clinic::active()->get();
    }

    public function render()
    {
        return view('livewire.pages.clinic-details', [
            'clinic' => $this->clinic,
            'clinics' => $this->clinics,
            'page' => $this->page,
        ]);
    }
}
