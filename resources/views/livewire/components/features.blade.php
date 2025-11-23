<div>

    <!-- feature-style-two -->
    <section class="feature-style-two p_relative pt_100 pb_100">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url(assets/images/shape/shape-14.png);"></div>
            <div class="pattern-2" style="background-image: url(assets/images/shape/shape-15.png);"></div>
        </div>
        <div class="auto-container">
            <div class="sec-title centred mb_50">
                <span class="sub-title">{{ gt('we_act') }}</span>
                <h2 class="text-center">{{ gt('home_heading') }}</h2>
            </div>
            <div class="row clearfix">
                @forelse($features as $index => $feature)
                <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                    <a href="{{ $feature->link ?? '#' }}">
                        <div class="feature-block-two wow fadeInUp animated" data-wow-delay="{{ $index * 200 }}ms"
                            data-wow-duration="1500m">
                            <div class="inner-box">
                                <div class="icon-box"><i class="{{ $feature->icon_class }}"></i></div>
                                <h3>
                                    {{ $feature->title }}
                                </h3>
                                <p>{{ $feature->description }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-two wow fadeInUp animated" data-wow-delay="00ms"
                        data-wow-duration="1500m">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-12"></i></div>
                            <h3><a href="#">Qualified Doctors</a></h3>
                            <p>Saudi Hospital is a leading private healthcare institution committed to
                                delivering high-quality.</p>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- feature-style-two end -->
</div>
