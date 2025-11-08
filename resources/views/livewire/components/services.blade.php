<div>

    <!-- service-style-two -->
    <section class="service-style-two p_relative">
        <div class="pattern-layer">
            <div class="pattern-1 p_absolute l_20 b_20"
                style="background-image: url(assets/images/shape/shape-18.png);"></div>
            <div class="pattern-2 p_absolute t_20 r_20"
                style="background-image: url(assets/images/shape/shape-19.png);"></div>
        </div>
        <div class="auto-container">
            <div class="sec-title centred mb_50">
                <span class="sub-title">Explore Medical Department</span>
                <h2>Centers of Excellence</h2>
            </div>
            <div class="row clearfix">
                @forelse($services as $index => $service)
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-one wow fadeInUp animated" data-wow-delay="{{ $index * 300 }}ms"
                        data-wow-duration="1500ms">
                        <div class="inner-box">
                            <figure class="image-box">
                                <img src="{{ $service->image_url }}" alt="{{ $service->title }}">
                                @if($service->link)
                                <a href="{{ $service->link }}"><i class="fas fa-link"></i></a>
                                @endif
                            </figure>
                            <div class="lower-content">
                                @if($service->icon_class)
                                <div class="icon-box"><i class="{{ $service->icon_class }}"></i></div>
                                @endif
                                <h3><a href="{{ $service->link ?? '#' }}">{{ $service->title }}</a></h3>
                                <p class="p_relative d_block">{{ $service->description }}</p>
                                @if($service->link)
                                <div class="link p_relative d_block"><a href="{{ $service->link }}">Read
                                        More</a></div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-one wow fadeInUp animated" data-wow-delay="00ms"
                        data-wow-duration="1500ms">
                        <div class="inner-box">
                            <figure class="image-box">
                                <img src="assets/images/service/service-2.jpg" alt="">
                                <a href="#"><i class="fas fa-link"></i></a>
                            </figure>
                            <div class="lower-content">
                                <div class="icon-box"><i class="icon-17"></i></div>
                                <h3><a href="#">Cardiology and Heart Center</a></h3>
                                <p class="p_relative d_block">We focus on accuracy safety and speed with care
                                    plans tailored to each patients.</p>
                                <div class="link p_relative d_block"><a href="#">Read More</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- service-style-two end -->
</div>