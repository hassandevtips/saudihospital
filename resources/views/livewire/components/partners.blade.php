<section class="project-section alternat-2 p_relative" style="margin-top: 60px; margin-bottom: 40px;">
    @if($partners && $partners->count() > 0)
    <div class="auto-container">
        <div class="sec-title centred mb_60">
            <h2 style="font-size: clamp(1.5rem, 4vw, 2rem);">
                {{ gt('our_partners', 'Our Partners') }}
            </h2>
        </div>
        <div class="project-carousel-2 owl-carousel owl-theme owl-dots-none owl-nav-none" style="margin-top: -40px;">
            @foreach($partners as $partner)
            <div class="project-block-one">
                <div class="inner-box">
                    @if($partner->website_url)
                    <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer">
                        <figure class="image-box">
                            <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" title="{{ $partner->name }}">
                        </figure>
                    </a>
                    @else
                    <figure class="image-box">
                        <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" title="{{ $partner->name }}">
                    </figure>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</section>
