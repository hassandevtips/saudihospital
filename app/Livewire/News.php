<?php

namespace App\Livewire;

use App\Models\News as NewsModel;
use Livewire\Component;

class News extends Component
{
    public function render()
    {
        return view('livewire.components.news', [
            'news' => NewsModel::active()->take(3)->get()
        ]);
    }
}
