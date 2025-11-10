<?php

namespace App\Livewire;

use App\Models\HomePageContent;
use Livewire\Component;

class HomePage extends Component
{
    public function render()
    {
        $content = HomePageContent::getContent();

        return view('livewire.pages.home-page', [
            'content' => $content
        ]);
    }
}
