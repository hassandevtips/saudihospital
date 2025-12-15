<section class="project-section alternat-2 p_relative" style="margin-top: 60px; margin-bottom: 40px;">
    @if($partners && $partners->count() > 0)
    <div class="auto-container">
        <div class="sec-title centred mb_60">
            <h2 style="font-size: clamp(1.5rem, 4vw, 2rem);">
                {{ gt('our_partners', 'Our Partners') }}
            </h2>
        </div>
        <div class="row clearfix" style="margin-top: -40px;">
            @foreach($partners as $partner)
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                <div class="project-block-one">
                    <div class="inner-box" style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); transition: transform 0.3s ease, box-shadow 0.3s ease; height: 100%; display: flex; align-items: center; justify-content: center;">
                        @if($partner->website_url)
                        <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer" style="display: block; width: 100%;">
                            <figure class="image-box" style="margin: 0; text-align: center;">
                                <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" title="{{ $partner->name }}" style="max-width: 100%; height: auto; max-height: 120px; object-fit: contain;">
                            </figure>
                        </a>
                        @else
                        <figure class="image-box" style="margin: 0; text-align: center;">
                            <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" title="{{ $partner->name }}" style="max-width: 100%; height: auto; max-height: 120px; object-fit: contain;">
                        </figure>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</section>

<style>
    .project-block-one .inner-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.15) !important;
    }

    @media (max-width: 767px) {
        .project-block-one .inner-box {
            padding: 15px !important;
        }
    }
</style>
