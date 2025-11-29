<?php

namespace App\Livewire;

use App\Models\Partner;
use Livewire\Component;

class Partners extends Component
{
    public function render()
    {
        $partners = Partner::active()->get();

        return view('livewire.components.partners', [
            'partners' => $partners,
        ]);
    }
}


