<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;

class Services extends Component
{
    public function render()
    {
        return view('livewire.components.services', [
            'services' => Service::active()->take(3)->get()
        ]);
    }
}
