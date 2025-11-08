<?php

namespace App\Livewire;

use App\Models\Feature;
use Livewire\Component;

class Features extends Component
{
    public function render()
    {
        return view('livewire.components.features', [
            'features' => Feature::active()->get()
        ]);
    }
}
