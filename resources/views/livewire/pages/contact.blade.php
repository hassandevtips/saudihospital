{{-- Contact Page Template --}}
<section class="page-title pt-10">
    <div class="bg-layer bg-primary" style=""></div>
    <div class="auto-container">
        <div class="content-box">
            <h1>{{ $page->title }}</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}" wire:navigate>Home</a></li>
                <li>{{ $page->title }}</li>
            </ul>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mb-4">
            <h2 style="color: #02799c;">Get in Touch</h2>
            <div class="page-content">
                {!! $page->content !!}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-body">
                    <h4 style="color: #02799c;">Contact Information</h4>
                    <p><i class="fas fa-phone text-primary"></i> {{ $settings['phone'] ?? 'N/A' }}</p>
                    <p><i class="fas fa-envelope text-primary"></i> {{ $settings['email'] ?? 'N/A' }}</p>
                    <p><i class="fas fa-map-marker-alt text-primary"></i> {{ $settings['address'] ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
