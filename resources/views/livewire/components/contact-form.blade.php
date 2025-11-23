<div>
    <section class="contact-section p_relative">
        <div class="bg-layer"></div>

        <div class="auto-container">
            <div class="sec-title centred light mb_45">
                <span class="sub-title">{{ gt('emergency-help', 'Emergency Help') }}</span>
                <h2 class="text-center">{{ gt('need_a_doctor', 'Need a Doctor for Check-up? Call for an Emergency
                    Service!') }}</h2>
            </div>
            <div class="support-box p_relative centred">
                <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-2.png') }}" alt=""></div>
                <h3 class="text-white text-center">Call: <a href="tel:{{ $phone }}" class="text-white">{{ $phone }}</a>
                </h3>
            </div>
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12 col-sm-12 form-column">
                    <div class="form-inner">
                        <h3>{{ gt('get_appointment', 'Get Appointment If You Need Consultation') }}</h3>
                        @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                        @endif
                        <form wire:submit="submitAppointment" class="default-form">
                            <div class="form-group">
                                <input type="text" wire:model="name" placeholder="{{ gt('your_name', 'Your Name') }}"
                                    required>
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <input type="email" wire:model="email" placeholder="{{ gt('email', 'Email') }}"
                                    required>
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <div class="icon"><i class="far fa-angle-down"></i></div>
                                <input type="text" wire:model="date"
                                    placeholder="{{ gt('appointment_date', 'Appointment Date') }}" id="datepicker">
                                @error('date') <span class="text-danger">{{ $message }}</span> @enderror
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
                            <a href="#" class="lightbox-image" data-caption=""><i class="fas fa-play"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-section end -->
</div>
