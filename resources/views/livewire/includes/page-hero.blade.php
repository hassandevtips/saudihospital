<section class="page-title ">
    <div class="bg-layer " style="
        background-image: url('{{ $page->banner_image_url ?? asset('assets/images/background/page-title.jpg') }}');

        "></div>
    <div class="auto-container">
        <div class="content-box @if($page->banner_image_url ?? false) text-white @endif">
            <h1 class="@if($page->banner_image_url ?? false) text-white @endif">{{ $page->title }}</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}" wire:navigate>Home</a></li>
                <li>{{ $page->title }}</li>
            </ul>
        </div>
    </div>
</section>