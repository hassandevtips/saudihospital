<?php

namespace App\Livewire;

use App\Models\Doctor;
use Livewire\Component;

class Doctors extends Component
{
    public function render()
    {
        return view('livewire.components.doctors', [
            'doctors' => Doctor::active()->take(3)->get()
        ]);
    }
}
