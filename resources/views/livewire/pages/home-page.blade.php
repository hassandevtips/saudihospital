<div>
    {{-- Banner/Slider Component --}}
    @livewire('banner-slider')

    {{-- Features Component --}}
    @livewire('features')

    {{-- About Section --}}
    <section class="about-section">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image_block_one">
                        <div class="image-box mr_30 pr_130 pb_100">
                            <div class="shape"
                                style="background-image: url({{ asset('assets/images/shape/shape-1.png') }});"></div>
                            <figure class="image"><img src="{{ $content->about_image_url }}" alt="">
                            </figure>
                            <div class="text p_absolute r_0 b_0">
                                <h2>{{ $content->about_years ?? 10 }}</h2>
                                <h4>{{ $content->about_years_text ?? 'Years of Experience in This Field' }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content_block_one">
                        <div class="content-box ml_30">
                            <div class="sec-title left p_relative d_block mb_25">
                                <span class="sub-title">{{ $content->about_subtitle ?? 'Who We Are?' }}</span>
                                <h2>{!! nl2br(e($content->about_title ?? 'Group Overview\nRedefining the Future of
                                    Healthcare')) !!}</h2>
                            </div>
                            <div class="text p_relative d_block">
                                <p>{{ $content->about_description ?? 'Saudi Hospital is a leading private healthcare
                                    institution committed to delivering high-quality, patient-centered medical care
                                    across a wide range of specialties.' }}</p>
                            </div>
                            <div class="inner-box">
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                        <div class="single-item">
                                            <h3>Key Highlights</h3>
                                            <ul class="list-style-one clearfix">
                                                @forelse($content->getKeyHighlightsList() as $highlight)
                                                <li>{{ $highlight }}</li>
                                                @empty
                                                <li>120+ Bed Capacity</li>
                                                <li>20+ Specialty Clinics</li>
                                                <li>8+ Centers of Excellence</li>
                                                <li>State of The Art Technology</li>
                                                @endforelse
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                        <div class="single-item">
                                            <h3>Services Offered</h3>
                                            <ul class="list-style-one clearfix">
                                                @forelse($content->getServicesOfferedList() as $service)
                                                <li>{{ $service }}</li>
                                                @empty
                                                <li>Internal Medicine</li>
                                                <li>Pediatrics</li>
                                                <li>Obstetrics & Gynecology</li>
                                                <li>Dermatology & Aesthetic Medicine</li>
                                                @endforelse
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Services Component --}}
    @livewire('services')

    {{-- Doctors Component --}}
    @livewire('doctors')

    {{-- Tabs Section (Static for now) --}}
    <section class="service-section p_relative bg-color-1">
        <div class="auto-container">
            <div class="tabs-box">
                <div class="tab-btn-box p_relative d_block mb_70 centred">
                    <ul class="tab-btns tab-buttons clearfix">
                        <li class="tab-btn active-btn" data-tab="#tab-1">
                            <div class="icon-box"><i class="icon-17"></i></div>
                            <h4>Patient Relations</h4>
                        </li>
                        <li class="tab-btn" data-tab="#tab-2">
                            <div class="icon-box"><i class="icon-18"></i></div>
                            <h4>Medical Tourism</h4>
                        </li>
                        <li class="tab-btn" data-tab="#tab-3">
                            <div class="icon-box"><i class="icon-19"></i></div>
                            <h4>Saudi Hospital History</h4>
                        </li>
                        <li class="tab-btn" data-tab="#tab-4">
                            <div class="icon-box"><i class="icon-20"></i></div>
                            <h4>Partners and Network</h4>
                        </li>
                        <li class="tab-btn" data-tab="#tab-5">
                            <div class="icon-box"><i class="icon-21"></i></div>
                            <h4>Our Core Values</h4>
                        </li>
                    </ul>
                </div>
                <div class="tabs-content">
                    <div class="tab active-tab" id="tab-1">
                        <div class="inner-box">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                                    <div class="content_block_two">
                                        <div class="content-box">
                                            <div class="text">
                                                <h3>Patient Relations</h3>
                                                <p>At Saudi Hospital, our Patient Relations Department is dedicated to
                                                    ensuring your healthcare journey is smooth, respectful, and
                                                    compassionate.</p>
                                            </div>
                                            <ul class="list-style-one clearfix">
                                                <li>Receive and address patient feedback</li>
                                                <li>Resolve concerns and complaints efficiently</li>
                                                <li>Patient rights education and support</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                                    <div class="image_block_two">
                                        <div class="image-box p_relative d_block">
                                            <figure class="image p_relative d_block"><img
                                                    src="{{ asset('assets/images/service/service-15.jpg') }}" alt="">
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="funfact-style-two p_relative" style="margin-top: 100px;">
        <div class="auto-container">
            <div class="inner-container bg-color-2 p_relative">
                <div class="counter-block-one wow slideInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="icon-box p_relative d_block fs_60"><i class="icon-25"></i></div>
                        <div class="count-outer count-box">
                            <span class="count-text" data-speed="1500"
                                data-stop="{{ $content->stats_doctors ?? 100 }}">0</span>
                        </div>
                        <p>Specialized Doctor</p>
                    </div>
                </div>
                <div class="counter-block-one wow slideInUp animated" data-wow-delay="200ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="icon-box p_relative d_block fs_60"><i class="icon-26"></i></div>
                        <div class="count-outer count-box">
                            <span class="count-text" data-speed="1500"
                                data-stop="{{ $content->stats_beds ?? 120 }}">0</span>
                        </div>
                        <p>Equipped Medical Bed</p>
                    </div>
                </div>
                <div class="counter-block-one wow slideInUp animated" data-wow-delay="400ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="icon-box p_relative d_block fs_60"><i class="icon-27"></i></div>
                        <div class="count-outer count-box">
                            <span class="count-text" data-speed="1500"
                                data-stop="{{ $content->stats_clinics ?? 20 }}">0</span>
                        </div>
                        <p>Specialized Medical Clinic</p>
                    </div>
                </div>
                <div class="counter-block-one wow slideInUp animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="icon-box p_relative d_block fs_60"><i class="icon-28"></i></div>
                        <div class="count-outer count-box">
                            <span class="count-text" data-speed="1500"
                                data-stop="{{ $content->stats_centers ?? 5 }}">0</span>
                        </div>
                        <p>Specialization Centers</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Pharmacy Section --}}
    <section class="chooseus-style-three p_relative" style="margin-top: 80px;">
        <div class="bg-layer"></div>
        <div class="pattern-layer" style="background-image: url({{ asset('assets/images/shape/shape-38.png') }});">
        </div>
        <figure class="image-layer"><img src="{{ $content->pharmacy_image_url }}" alt=""></figure>
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 offset-lg-6">
                    <div class="content_block_eight">
                        <div class="content-box p_relative d_block">
                            <div class="shape"
                                style="background-image: url({{ asset('assets/images/shape/shape-37.png') }});"></div>
                            <div class="text p_relative d_block">
                                <h2>{{ $content->pharmacy_title ?? 'Safe, Reliable, and Patient-Centered Medication.' }}
                                </h2>
                                <p>{{ $content->pharmacy_description ?? 'The Pharmacy Department at Alsaudi Hospital is
                                    a vital part of our integrated healthcare system.' }}</p>
                            </div>
                            <div class="inner-box">
                                <div class="row clearfix">
                                    @if($content->pharmacy_services && is_array($content->pharmacy_services))
                                    @php
                                    $pharmacyServices = isset($content->pharmacy_services[app()->getLocale()])
                                    ? $content->pharmacy_services[app()->getLocale()]
                                    : (is_array($content->pharmacy_services) ? reset($content->pharmacy_services) : []);
                                    if (!is_array($pharmacyServices)) $pharmacyServices = [];
                                    @endphp
                                    @forelse($pharmacyServices as $service)
                                    <div class="col-lg-12 col-md-6 col-sm-12 single-column">
                                        <div class="single-item">
                                            <h4><a href="#">{{ is_array($service) && isset($service['title']) ?
                                                    $service['title'] : ($service['title'] ?? 'Service') }}</a></h4>
                                            @if(is_array($service) && isset($service['description']))
                                            <p>{{ $service['description'] }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    @empty
                                    <div class="col-lg-12 col-md-6 col-sm-12 single-column">
                                        <div class="single-item">
                                            <h4><a href="#">Inpatient Pharmacy Services</a></h4>
                                            <p>24/7 medication dispensing for hospitalized patients.</p>
                                        </div>
                                    </div>
                                    @endforelse
                                    @else
                                    <div class="col-lg-12 col-md-6 col-sm-12 single-column">
                                        <div class="single-item">
                                            <h4><a href="#">Inpatient Pharmacy Services</a></h4>
                                            <p>24/7 medication dispensing for hospitalized patients.</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    {{-- News Component --}}
    @livewire('news')

    {{-- Insurances Section --}}
    @if($content->insurances_title || ($content->insurance_logos && is_array($content->insurance_logos) &&
    count($content->insurance_logos) > 0))
    <section class="project-section alternat-2 p_relative" style="margin-top: 60px; margin-bottom: 40px;">
        <div class="auto-container">
            <div class="sec-title centred mb_50">
                <h2>{{ $content->insurances_title ?? 'Insurances' }}</h2>
            </div>
            <div class="project-carousel-2 owl-carousel owl-theme owl-dots-none owl-nav-none"
                style="margin-top: -40px;">
                @if($content->insurance_logos && is_array($content->insurance_logos))
                @php
                $logos = is_array($content->insurance_logos) ? $content->insurance_logos : [];
                @endphp
                @forelse($logos as $logo)
                @php
                $logoPath = is_array($logo) && isset($logo['logo']) ? $logo['logo'] : (is_string($logo) ? $logo : null);
                $logoUrl = $logoPath ? (str_starts_with($logoPath, 'assets') ? asset($logoPath) : asset('storage/' .
                $logoPath)) : asset('assets/images/news/brand-1.png');
                @endphp
                <div class="project-block-one">
                    <div class="inner-box">
                        <figure class="image-box"><img src="{{ $logoUrl }}" alt=""></figure>
                    </div>
                </div>
                @empty
                <div class="project-block-one">
                    <div class="inner-box">
                        <figure class="image-box"><img src="{{ asset('assets/images/news/brand-1.png') }}" alt="">
                        </figure>
                    </div>
                </div>
                <div class="project-block-one">
                    <div class="inner-box">
                        <figure class="image-box"><img src="{{ asset('assets/images/news/brand-2.png') }}" alt="">
                        </figure>
                    </div>
                </div>
                @endforelse
                @else
                <div class="project-block-one">
                    <div class="inner-box">
                        <figure class="image-box"><img src="{{ asset('assets/images/news/brand-1.png') }}" alt="">
                        </figure>
                    </div>
                </div>
                <div class="project-block-one">
                    <div class="inner-box">
                        <figure class="image-box"><img src="{{ asset('assets/images/news/brand-2.png') }}" alt="">
                        </figure>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif
</div>