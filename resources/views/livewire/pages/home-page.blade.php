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
                                <h2 class="text-center">{{ $content->about_years ?? 10 }}</h2>
                                <h4 class="text-center">{{ $content->about_years_text ?? gt('years_of_experience',
                                    'Years of Experience in
                                    This Field') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content_block_one">
                        <div class="content-box ml_30">
                            <div class="sec-title left p_relative d_block mb_25">
                                <span class="sub-title">{{ $content->about_subtitle ?? gt('who_we_are', 'Who We Are?')
                                    }}</span>
                                <h2>{!! nl2br(e($content->about_title ?? gt('group_overview', 'Group
                                    Overview\nRedefining the Future of Healthcare'))) !!}</h2>
                            </div>
                            <div class="text p_relative d_block">
                                <p>{{ $content->about_description ?? gt('about_description', 'Saudi Hospital is a
                                    leading private healthcare institution committed to delivering high-quality,
                                    patient-centered medical care across a wide range of specialties.') }}</p>
                            </div>
                            <div class="inner-box">
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                        <div class="single-item">
                                            <h3>{{ gt('key_highlights') }}</h3>
                                            <ul class="list-style-one clearfix">
                                                @forelse($content->getKeyHighlightsList() as $highlight)
                                                <li>{{ $highlight }}</li>
                                                @empty
                                                <li>{{ gt('bed_capacity', '120+ Bed Capacity') }}</li>
                                                <li>{{ gt('specialty_clinics', '20+ Specialty Clinics') }}</li>
                                                <li>{{ gt('centers_of_excellence', '8+ Centers of Excellence') }}</li>
                                                <li>{{ gt('state_of_art_technology', 'State of The Art Technology') }}
                                                </li>
                                                @endforelse
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                        <div class="single-item">
                                            <h3>{{ gt('services-offered') }}</h3>
                                            <ul class="list-style-one clearfix">
                                                @forelse($content->getServicesOfferedList() as $service)
                                                <li>{{ $service }}</li>
                                                @empty
                                                <li>{{ gt('internal_medicine', 'Internal Medicine') }}</li>
                                                <li>{{ gt('pediatrics', 'Pediatrics') }}</li>
                                                <li>{{ gt('obstetrics_gynecology', 'Obstetrics & Gynecology') }}</li>
                                                <li>{{ gt('dermatology_aesthetic', 'Dermatology & Aesthetic Medicine')
                                                    }}</li>
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

    {{-- Tabs Section --}}
    @php
    $tabs = $content->getTabsList();
    @endphp
    @if(count($tabs) > 0)
    <section class="service-section p_relative bg-color-1">
        <div class="auto-container">
            <div class="tabs-box">
                <div class="tab-btn-box p_relative d_block mb_70 centred">
                    <ul class="tab-btns tab-buttons clearfix">
                        @foreach($tabs as $index => $tab)
                        <li class="tab-btn {{ $index === 0 ? 'active-btn' : '' }}" data-tab="#tab-{{ $index + 1 }}">
                            <div class="icon-box"><i class="{{ $tab['icon'] ?? 'icon-17' }}"></i></div>
                            <h4>{{ $tab['title'] ?? 'Tab ' . ($index + 1) }}</h4>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="tabs-content">
                    @foreach($tabs as $index => $tab)
                    <div class="tab {{ $index === 0 ? 'active-tab' : '' }}" id="tab-{{ $index + 1 }}">
                        <div class="inner-box">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                                    <div class="content_block_two">
                                        <div class="content-box">
                                            <div class="text">
                                                <h3>{{ $tab['heading'] ?? $tab['title'] ?? 'Tab Content' }}</h3>
                                                <p>{{ $tab['description'] ?? '' }}</p>
                                            </div>
                                            @if(isset($tab['list_items']) && is_array($tab['list_items']) &&
                                            count($tab['list_items']) > 0)
                                            <ul class="list-style-one clearfix">
                                                @foreach($tab['list_items'] as $listItem)
                                                <li>{{ is_array($listItem) && isset($listItem['item']) ?
                                                    $listItem['item'] : $listItem }}</li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                                    <div class="image_block_two">
                                        <div class="image-box p_relative d_block">
                                            @php
                                            $tabImage = $tab['image'] ?? null;
                                            $imageUrl = $tabImage
                                            ? (str_starts_with($tabImage, 'assets')
                                            ? asset($tabImage)
                                            : asset('storage/' . $tabImage))
                                            : asset('assets/images/service/service-15.jpg');
                                            @endphp
                                            <figure class="image p_relative d_block"><img src="{{ $imageUrl }}"
                                                    alt="{{ $tab['title'] ?? '' }}">
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Stats Section --}}
    <section class="funfact-style-two p_relative" style="margin-top: 100px;">
        <div class="auto-container">
            <div class="inner-container bg-color-2 p_relative">
                <div class="counter-block-one wow slideInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="icon-box p_relative d_block fs_60"><i
                                class="{{ $content->stats_doctors_icon ?? 'icon-25' }}"></i></div>
                        <div class="count-outer count-box">
                            <span class="count-text" data-speed="1500"
                                data-stop="{{ $content->stats_doctors ?? 100 }}">0</span>
                        </div>
                        <p>{{ gt('specialized_doctor', 'Specialized Doctor') }}</p>
                    </div>
                </div>
                <div class="counter-block-one wow slideInUp animated" data-wow-delay="200ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="icon-box p_relative d_block fs_60"><i
                                class="{{ $content->stats_beds_icon ?? 'icon-26' }}"></i></div>
                        <div class="count-outer count-box">
                            <span class="count-text" data-speed="1500"
                                data-stop="{{ $content->stats_beds ?? 120 }}">0</span>
                        </div>
                        <p>{{ gt('medical-bed', 'Equipped Medical Bed') }}</p>
                    </div>
                </div>
                <div class="counter-block-one wow slideInUp animated" data-wow-delay="400ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="icon-box p_relative d_block fs_60"><i
                                class="{{ $content->stats_clinics_icon ?? 'icon-27' }}"></i></div>
                        <div class="count-outer count-box">
                            <span class="count-text" data-speed="1500"
                                data-stop="{{ $content->stats_clinics ?? 20 }}">0</span>
                        </div>
                        <p>{{ gt('medical-clinic', 'Specialized Medical Clinic') }}</p>
                    </div>
                </div>
                <div class="counter-block-one wow slideInUp animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="icon-box p_relative d_block fs_60"><i
                                class="{{ $content->stats_centers_icon ?? 'icon-28' }}"></i></div>
                        <div class="count-outer count-box">
                            <span class="count-text" data-speed="1500"
                                data-stop="{{ $content->stats_centers ?? 5 }}">0</span>
                        </div>
                        <p>{{ gt('specialization-centers', 'Specialization Centers') }}</p>
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
                                    @forelse($content->getPharmacyServicesList() as $service)
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
                                            <h4><a href="#">{{ gt('inpatient_pharmacy', 'Inpatient Pharmacy Services')
                                                    }}</a></h4>
                                            <p>{{ gt('inpatient_pharmacy_desc', '24/7 medication dispensing for
                                                hospitalized patients.') }}</p>
                                        </div>
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="contact-section p_relative">
        <div class="bg-layer"></div>

        <div class="auto-container">
            <div class="sec-title centred light mb_45">
                <span class="sub-title">{{ gt('emergency-help', 'Emergency Help') }}</span>
                <h2 class="text-center">{{ gt('need_a_doctor', 'Need a Doctor for Check-up? Call for an Emergency
                    Service!') }}</h2>
            </div>
            <div class="support-box p_relative centred">
                <div class="icon-box"><img src="assets/images/icons/icon-2.png" alt=""></div>
                <h3 class="text-white text-center">{{ gt('call', 'Call') }}: <a href="tel:0096265564400"
                        class="text-white">00962 5564400</a></h3>
            </div>
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12 col-sm-12 form-column">
                    <div class="form-inner">
                        <h3>{{ gt('get_appointment', 'Get Appointment If You Need Consultation') }}</h3>
                        <form wire:submit.prevent="submitAppointment" class="default-form">
                            <div class="form-group">
                                <input type="text" wire:model.defer="form.patient_name"
                                    placeholder="{{ gt('your_name', 'Your Name') }}" required="">
                            </div>
                            <div class="form-group">
                                <input type="email" wire:model.defer="form.patient_email"
                                    placeholder="{{ gt('email', 'Email') }}" required="">
                                @error('form.patient_email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="tel" wire:model.defer="form.patient_phone"
                                    placeholder="{{ gt('phone_number', 'Phone Number') }}" required="">
                                @error('form.patient_phone')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="icon"><i class="far fa-angle-down"></i></div>
                                <input type="text" wire:model.defer="form.appointment_date"
                                    placeholder="{{ gt('appointment_date', 'Appointment Date') }}" id="datepicker">
                                @error('form.appointment_date')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <textarea wire:model.defer="form.message"
                                    placeholder="{{ gt('message_optional', 'Message (optional)') }}"></textarea>
                                @error('form.message')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group message-btn">
                                <button type="submit" class="theme-btn btn-two">{{ gt('make_appointment', 'Make
                                    Appointment') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 video-column">
                    <div class="video-inner" style="background-image: url(assets/images/background/video-bg.jpg);">
                        <div class="video-btn">
                            <a href="{{ $content->video_url ?? '#' }}" class="lightbox-image" data-caption=""><i
                                    class="fas fa-play"></i></a>
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
                <h2 style="font-size: clamp(1.5rem, 4vw, 2rem);">{{ $content->insurances_title ?? gt('insurances',
                    'Insurances') }}</h2>
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

    {{-- Responsive Styles for Home Page --}}
    <style>
        @media (max-width: 991px) {

            /* About Section */
            .about-section .image_block_one .image-box {
                margin-right: 0 !important;
                margin-bottom: 30px;
            }

            .about-section .content_block_one .content-box {
                margin-left: 0 !important;
            }

            /* Stats Section */
            .funfact-style-two .inner-container {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }

            .counter-block-one {
                width: 50%;
                margin-bottom: 30px;
            }

            /* Pharmacy Section */
            .chooseus-style-three .image-layer {
                position: relative !important;
                height: 300px;
                margin-bottom: 30px;
            }

            .chooseus-style-three .content_block_eight .content-box {
                padding: 30px 20px;
            }

            /* Contact/Appointment Section */
            .contact-section .form-inner {
                margin-bottom: 30px;
            }

            .contact-section .video-inner {
                min-height: 300px;
            }
        }

        @media (max-width: 767px) {

            /* About Section Mobile */
            .about-section {
                padding: 50px 0 !important;
            }

            .about-section .image_block_one .image-box .text {
                position: relative !important;
                width: 100% !important;
                margin-top: 20px;
            }

            .about-section .content_block_one .content-box .inner-box .single-item {
                margin-bottom: 20px;
            }

            /* Tabs Section Mobile */
            .service-section .tab-btns li {
                width: 100%;
                margin-bottom: 15px !important;
            }

            .service-section .tabs-content .tab .inner-box .image-column {
                margin-top: 30px;
            }

            /* Stats Section Mobile */
            .funfact-style-two {
                margin-top: 50px !important;
            }

            .counter-block-one {
                width: 50%;
            }

            .counter-block-one .inner-box {
                padding: 20px 10px;
            }

            .counter-block-one .icon-box {
                font-size: 40px !important;
            }

            .counter-block-one .count-outer {
                font-size: 28px;
            }

            .counter-block-one p {
                font-size: 12px;
            }

            /* Pharmacy Section Mobile */
            .chooseus-style-three {
                padding: 50px 0 100px 0 !important;
            }

            .chooseus-style-three .image-layer {
                display: none;
            }

            .chooseus-style-three .content_block_eight .content-box .text h2 {
                font-size: 24px !important;
                line-height: 34px !important;
            }

            /* Contact/Appointment Section Mobile */
            .contact-section {
                padding: 50px 0 !important;
            }

            .contact-section .sec-title h2 {
                font-size: 24px;
                line-height: 34px;
            }

            .contact-section .support-box h3 {
                font-size: 18px;
            }

            .contact-section .form-inner {
                padding: 30px 20px;
            }

            .contact-section .form-inner h3 {
                font-size: 20px;
                line-height: 28px;
            }

            .contact-section .video-inner {
                min-height: 250px !important;
                padding: 100px 0 !important;
            }
        }

        @media (max-width: 575px) {

            /* About Section Extra Small */
            .about-section .sec-title h2 {
                font-size: 24px;
                line-height: 34px;
            }

            .about-section .sec-title .sub-title {
                font-size: 14px;
            }

            /* Counter Section Extra Small */
            .counter-block-one {
                width: 50%;
            }

            .counter-block-one .count-outer {
                font-size: 24px;
            }

            .counter-block-one p {
                font-size: 11px;
                line-height: 16px;
            }

            /* Tabs Extra Small */
            .service-section .tab-btns li h4 {
                font-size: 14px;
            }

            .service-section .tab-btns li .icon-box {
                font-size: 30px;
            }
        }
    </style>

    @script
    <script>
        $wire.on('redirect-to-whatsapp', (event) => {
            window.open(event.url, '_blank');
        });
    </script>
    @endscript
</div>
