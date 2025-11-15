<?php

namespace App\Livewire;

use App\Models\Clinic;
use Livewire\Component;

class Clinics extends Component
{
    public function render()
    {
        return view('livewire.components.clinics', [
            'clinics' => Clinic::active()->get()
        ]);
    }
}
