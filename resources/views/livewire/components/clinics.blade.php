<div>

    <!-- service-style-three -->
    <section class="service-style-three service-page-2 centred">
        <div class="auto-container">
            <div class="row clearfix">
                @forelse($clinics as $index => $clinic)
                <div class="col-lg-3 col-md-6 col-sm-12 service-block">
                    <div class="service-block-two wow fadeInUp animated" data-wow-delay="{{ $index * 100 }}ms"
                        data-wow-duration="1500ms">
                        <div class="inner-box">
                            @if($clinic->icon_image_url)
                            <div class="icon-box">
                                <img src="{{ $clinic->icon_image_url }}" alt="{{ $clinic->title }}"
                                    style="max-width: 80px; max-height: 80px;">
                            </div>
                            @else
                            <div class="icon-box"><i class="icon-17"></i></div>
                            @endif
                            <h3><a href="{{ route('clinic.details', $clinic->slug) }}">{{ $clinic->title }}</a></h3>
                            <p>{{ $clinic->short_description }}</p>
                            <div class="link-text"><a href="{{ route('clinic.details', $clinic->slug) }}">{{
                                    gt('read-more') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p>No clinics available at the moment.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- service-style-three end -->
</div>
