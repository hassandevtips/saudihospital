<?php

namespace App\Livewire;

use App\Models\News;
use Livewire\Component;

class NewsDetails extends Component
{

    public $page;
    public News $news;
    public function mount(News $id): void
    {
        $news = $id;
        $this->page = (object) [
            'title' => $news->title . ' Details',
            'banner_image_url' => $news->banner_image_url,
        ];

        $this->news = $news;
    }



    public function render()
    {
        return view('livewire.pages.news-details', [
            'page' => $this->page,
            'news' => $this->news,
        ]);
    }
}
