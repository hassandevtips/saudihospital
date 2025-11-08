<?php

namespace App\Livewire;

use App\Models\Banner;
use Livewire\Component;

class BannerSlider extends Component
{
    public function render()
    {
        return view('livewire.components.banner-slider', [
            'banners' => Banner::active()->get()
        ]);
    }
}
