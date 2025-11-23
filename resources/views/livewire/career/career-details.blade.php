<!-- about-section -->
<section class="about-section">
    <div class="auto-container">
        <div class="row clearfix">

            <div class="col-lg-12 col-md-12 col-sm-12 content-column">
                <div class="content_block_one">
                    <div class="content-box ml_30">
                        <div class="sec-title left p_relative d_block mb_25">
                            <h2>{{ $vacancy->title }} - {{ $vacancy->location }}</h2>
                            <h3>{{ $vacancy->department }} - {{ $vacancy->employment_type }}</h3>
                        </div>
                        <div class="text p_relative d_block">
                            @if (!empty($vacancy->summary))
                            <p>{!! nl2br(e($vacancy->summary)) !!}</p>
                            @endif
                            @if (!empty($vacancy->description))
                            <p>{!! nl2br(e($vacancy->description)) !!}</p>
                            @endif
                        </div>
                        <div class="inner-box">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                    <div class="single-item">
                                        <h3>{{ gt('requirements', 'Requirements') }}</h3>
                                        @php
                                        $requirements = [];

                                        if (!empty($vacancy->requirements)) {
                                        $requirements = is_array($vacancy->requirements)
                                        ? $vacancy->requirements
                                        : preg_split('/\r\n|\r|\n/', (string) $vacancy->requirements);
                                        }
                                        @endphp
                                        <ul class="list-style-one clearfix">
                                            @foreach ($requirements as $requirement)
                                            @if (filled($requirement))
                                            <li>{{ strip_tags($requirement) }}</li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                    <div class="single-item">
                                        <h3>{{ gt('time_to_apply', 'Time to Apply') }}</h3>
                                        <ul class="list-style-one clearfix">
                                            @if ($vacancy->closing_at)
                                            <li>{{ gt('apply_before', 'Apply before') }} {{ $vacancy->closing_at->translatedFormat('M d,
                                                Y') }}</li>
                                            @endif
                                            @if ($vacancy->posted_at)
                                            <li>{{ gt('posted_on', 'Posted on') }} {{ $vacancy->posted_at->translatedFormat('M d, Y')
                                                }}</li>
                                            @endif
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
<!-- about-section end -->


<!-- Application Form -->
<div class="application-form-section contact-style-two p_relative">
    <div class="application-form-wrapper form-inner">
        <div class="application-form-header">
            <h3>{{ gt('apply_for_position', 'Apply for this Position') }}</h3>
            <p>{{ gt('fill_form_submit', 'Fill out the form below to submit your application') }}</p>
        </div>

        @if (session()->has('career_success'))
        <div class="alert alert-success">
            {{ session('career_success') }}
        </div>
        @endif

        <form wire:submit.prevent="submit" class="contact-form">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                    <input type="text" wire:model.defer="form.name" placeholder="{{ gt('your_name', 'Your Name') }} *" required>
                    @error('form.name')
                    <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                    <input type="email" wire:model.defer="form.email" placeholder="{{ gt('email_address', 'Email Address') }} *"
                        required>
                    @error('form.email')
                    <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                    <input type="text" wire:model.defer="form.phone" placeholder="{{ gt('phone_number', 'Phone Number') }}">
                    @error('form.phone')
                    <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                    <input type="text" wire:model.defer="form.current_position"
                        placeholder="{{ gt('current_position', 'Current Position') }}">
                    @error('form.current_position')
                    <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <input type="url" wire:model.defer="form.resume_url"
                        placeholder="{{ gt('resume_url_placeholder', 'Resume/CV URL (LinkedIn, Google Drive, etc.)') }}">
                    @error('form.resume_url')
                    <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <textarea wire:model.defer="form.cover_letter" placeholder="{{ gt('cover_letter_message', 'Cover Letter or Message') }}"
                        rows="6"></textarea>
                    @error('form.cover_letter')
                    <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn mr-0 centred">
                    <button class="theme-btn btn-one" type="submit">
                        <span wire:loading.remove wire:target="submit">{{ gt('submit_application', 'Submit Application') }}</span>
                        <span wire:loading wire:target="submit">{{ gt('submitting', 'Submitting...') }}</span>
                    </button>
                </div>
            </div>
        </form>
    </div>