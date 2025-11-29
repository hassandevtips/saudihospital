{{-- Default Page Template --}}
@include('livewire.includes.page-hero')

<div class="container py-5">
    <div class="row">
        <div class="col-lg-12">
            @if($page->featured_image_url)
            <img src="{{ $page->featured_image_url }}" alt="{{ $page->title }}" class="img-fluid rounded mb-4">
            @endif

            <div class="page-content">
                {!! html_entity_decode($page->content) !!}

                @livewire('partners')

            </div>
        </div>
    </div>
</div>
