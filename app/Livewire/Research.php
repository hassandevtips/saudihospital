<?php

namespace App\Livewire;

use App\Models\Research as ResearchModel;
use Livewire\Component;

class Research extends Component
{
    public function render()
    {
        return view('livewire.components.research', [
            'research' => ResearchModel::active()->take(3)->get()
        ]);
    }
}

