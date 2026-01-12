<?php

namespace App\Livewire;

use App\Models\Research;
use Livewire\Component;

class ResearchDetails extends Component
{

    public $page;
    public Research $research;
    public function mount(Research $id): void
    {
        $research = $id;
        $this->page = (object) [
            'title' => $research->title,
            'banner_image_url' => $research->banner_image_url,
        ];

        $this->research = $research;
    }



    public function render()
    {
        return view('livewire.pages.research-details', [
            'page' => $this->page,
            'research' => $this->research,
        ]);
    }
}

