{{-- Default Page Template --}}
<section class="page-title pt-10">
    <div class="bg-layer @if(!$page->banner_image_url) bg-primary @endif" style="
        background-image: url('{{ $page->banner_image_url }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        "></div>
    <div class="auto-container">
        <div class="content-box @if($page->banner_image_url) text-white @endif">
            <h1 class="@if($page->banner_image_url) text-white @endif">{{ $page->title }}</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}" wire:navigate>Home</a></li>
                <li>{{ $page->title }}</li>
            </ul>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-12">
            @if($page->featured_image_url)
            <img src="{{ $page->featured_image_url }}" alt="{{ $page->title }}" class="img-fluid rounded mb-4">
            @endif

            <div class="page-content">
                {!! $page->content !!}
            </div>
        </div>
    </div>
</div>
