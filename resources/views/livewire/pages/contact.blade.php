<section>
    {{-- Contact Page Template --}}
    @include('livewire.includes.page-hero');


    <!-- contact-info-section -->
    <section class="contact-info-section centred">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-6 col-sm-12 info-column">
                    <div class="single-item">
                        <div class="icon-box"><i class="icon-57"></i></div>
                        <h3>{{ gt('office_location', 'Office Location') }}</h3>
                        <p>{{ $settings['address'] ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 info-column">
                    <div class="single-item">
                        <div class="icon-box"><i class="icon-58"></i></div>
                        <h3>{{ gt('company_email', 'Company Email') }}</h3>
                        <p><a href="mailto:{{ $settings['email'] ?? 'N/A' }}">{{ $settings['email'] ?? 'N/A' }}</a></p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 info-column">
                    <div class="single-item">
                        <div class="icon-box"><i class="icon-59"></i></div>
                        <h3>{{ gt('contact_us', 'Contact Us') }}</h3>
                        <p><a href="tel:{{ $settings['phone'] ?? 'N/A' }}">{{ $settings['phone'] ?? 'N/A' }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-info-section end -->


    <!-- contact-style-two -->
    <section class="contact-style-two p_relative">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 big-column offset-lg-2">
                    <div class="form-inner">
                        <h2>{{ gt('leave_a_comment', 'Leave a Comment') }}</h2>
                        <livewire:contact-form />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-style-two end -->


</section>
