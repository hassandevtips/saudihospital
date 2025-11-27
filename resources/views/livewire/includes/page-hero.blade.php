<section class="page-title ">
    <div class="bg-layer " @if(isset($banner_image_url) && $banner_image_url)
        style="background-image: url('{{ $banner_image_url }}');" @else
        style="background-image: url('{{ $page->banner_image_url ?? asset('assets/images/background/page-title1.jpg') }}');"
        @endif></div>
    <div class="auto-container">
        <div class="content-box @if($page->banner_image_url ?? false) text-white @endif">
            <h1 class="text-white">{{ $page->title }}</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}" wire:navigate>{{ gt('home', 'Home') }}</a></li>
                <li>{{ $page->title }}</li>
            </ul>
        </div>
    </div>
</section>
