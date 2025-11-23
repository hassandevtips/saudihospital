<div>
    <!-- banner-section -->
    <section class="banner-style-two centred p_relative">
        <div class="banner-carousel owl-theme owl-carousel owl-dots-none">
            @forelse($banners as $banner)
            <div class="slide-item p_relative">
                <div class="image-layer p_absolute" style="background-image:url({{ $banner->image_url }})">
                </div>
                <div class="pattern-layer">
                    <div class="pattern-2" style="background-image: url(assets/images/shape/shape-12.png);">
                    </div>
                </div>
                <div class="auto-container">
                    <div class="content-box">
                        <h2 class="text-center">{{ $banner->title }}</h2>
                        @if($banner->description)
                        <p class="text-center">{{ $banner->description }}</p>
                        @endif
                        @if($banner->button_text && $banner->button_link)
                        <div class="btn-box">
                            <a href="{{ $banner->button_link }}" class="theme-btn btn-one">{{
                                $banner->button_text }}</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="slide-item p_relative">
                <div class="image-layer p_absolute" style="background-image:url(assets/images/banner/banner-1.jpg)">
                </div>
                <div class="pattern-layer">
                    <div class="pattern-2" style="background-image: url(assets/images/shape/shape-12.png);">
                    </div>
                </div>
                <div class="auto-container">
                    <div class="content-box">
                        <h2>{{ gt('trusted_healthcare', 'Trusted Healthcare Services') }}</h2>
                        <p>{{ gt('trusted_healthcare_desc', 'Over the years, thanks to the trust of our community and the commitment of our staff.!') }}</p>
                        <div class="btn-box">
                            <a href="#" class="theme-btn btn-one">{{ gt('meet_our_doctors', 'Meet Our Doctors') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </section>
    <!-- banner-section end -->
</div>
