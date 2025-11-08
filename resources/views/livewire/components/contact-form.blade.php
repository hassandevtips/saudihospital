<div>
    <section class="contact-section p_relative">
        <div class="bg-layer"></div>

        <div class="auto-container">
            <div class="sec-title centred light mb_45">
                <span class="sub-title">Emergency Help</span>
                <h2>Need a Doctor for Check-up? Call for an <br />Emergency Service!</h2>
            </div>
            <div class="support-box p_relative centred">
                <div class="icon-box"><img src="{{ asset('assets/images/icons/icon-2.png') }}" alt=""></div>
                <h3 style="color: #fff;">Call: <a href="tel:{{ $phone }}" style=" color: #fff;">{{ $phone }}</a></h3>
            </div>
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12 col-sm-12 form-column">
                    <div class="form-inner">
                        <h3>Get Appointment If You <span style="color: #fff;">Need Consultation</span></h3>
                        @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                        @endif
                        <form wire:submit="submitAppointment" class="default-form">
                            <div class="form-group">
                                <input type="text" wire:model="name" placeholder="Your Name" required>
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <input type="email" wire:model="email" placeholder="Email" required>
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <div class="icon"><i class="far fa-angle-down"></i></div>
                                <input type="text" wire:model="date" placeholder="Appointment date" id="datepicker">
                                @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group message-btn">
                                <button type="submit" class="theme-btn btn-two">Make Appointment</button>
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