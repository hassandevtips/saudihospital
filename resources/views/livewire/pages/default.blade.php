{{-- Default Page Template --}}
<section class="page-title pt-10">
    <div class="bg-layer bg-primary" style=""></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>{{ $page->title }}</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
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
