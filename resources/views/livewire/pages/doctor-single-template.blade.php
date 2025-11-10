<section>
    {{-- Default Page Template --}}
    @include('livewire.includes.page-hero');


    <!-- team-details -->
    <section class="team-details p_relative">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-5 col-md-12 col-sm-12 image-column">
                    <figure class="image-box"><img src="{{ $doctor->image_url }}" alt=""></figure>
                </div>
                <div class="col-lg-7 col-md-12 col-sm-12 content-column">
                    <div class="team-details-content">
                        <div class="team-info">
                            <h2>{{ $doctor->name }}</h2>
                            <span class="designation">{{ $doctor->specialization }}</span>
                            <p>{!! $doctor->bio !!}</p>
                            <ul class="list clearfix">
                                <li><span>Occupation:</span>{{ $doctor->department->name }}</li>
                                <li><span>Phone:</span><a href="tel:{{ $doctor->phone }}">{{ $doctor->phone }}</a></li>
                                <li><span>Email:</span><a href="mailto:{{ $doctor->email }}">{{ $doctor->email }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="skills-box">
                            <div class="text">
                                <h3>{{ __('My Skills') }}</h3>
                                <p>{!! $doctor->department->description !!}</p>
                            </div>

                        </div>
                        <div class="contact-box">
                            <div class="text">
                                <h3>Book an Appointment</h3>
                            </div>
                            <div class="form-inner">
                                @if (session()->has('appointment_success'))
                                <div class="alert alert-success mb-3">
                                    {{ session('appointment_success') }}
                                </div>
                                @endif

                                <form wire:submit.prevent="submitAppointment">
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <input type="date" wire:model.defer="form.appointment_date" required="">
                                                @error('form.appointment_date')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 column">
                                            <div class="form-group">
                                                <input type="text" wire:model.defer="form.patient_name"
                                                    placeholder="Your name" required="">
                                                @error('form.patient_name')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 column">
                                            <div class="form-group">
                                                <input type="email" wire:model.defer="form.patient_email"
                                                    placeholder="Your Email" required="">
                                                @error('form.patient_email')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <input type="text" wire:model.defer="form.patient_phone"
                                                    placeholder="Phone" required="">
                                                @error('form.patient_phone')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <textarea wire:model.defer="form.message"
                                                    placeholder="Message"></textarea>
                                                @error('form.message')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group message-btn">
                                                <button type="submit" class="theme-btn btn-one"
                                                    wire:loading.attr="disabled">
                                                    <span wire:loading.remove>Send Message</span>
                                                    <span wire:loading>Sending...</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- team-details end -->

</section>