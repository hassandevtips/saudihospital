<section>
    {{-- Default Page Template --}}
    @include('livewire.includes.page-hero')

    {{-- Appointment Booking Styles --}}
    <link rel="stylesheet" href="{{ asset('css/appointment-booking.css') }}">
    <script src="{{ asset('js/appointment-booking.js') }}" defer></script>



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

                                @if (session()->has('appointment_error'))
                                <div class="alert alert-danger mb-3">
                                    {{ session('appointment_error') }}
                                </div>
                                @endif

                                <form wire:submit.prevent="submitAppointment">
                                    <div class="row clearfix">

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
                                                <label class="appointment-form-label">Select Appointment Date</label>
                                                <input class="form-control" type="date"
                                                    wire:model.live="form.appointment_date" min="{{ date('Y-m-d') }}"
                                                    required="">
                                                @error('form.appointment_date')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        @if (!empty($form['appointment_date']))
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div wire:loading wire:target="form.appointment_date"
                                                class="time-slots-loading">
                                                Loading available time slots
                                            </div>

                                            <div wire:loading.remove wire:target="form.appointment_date">
                                                @if (!$isDoctorAvailable)
                                                <div class="availability-alert warning">
                                                    <strong>⚠️ Doctor Not Available</strong>
                                                    The doctor is not available on this day. Please select another date.
                                                </div>
                                                @elseif (empty($availableSlots))
                                                <div class="availability-alert info">
                                                    <strong>ℹ️ All Slots Booked</strong>
                                                    All appointment slots are fully booked for this date. Please select
                                                    another date.
                                                </div>
                                                @else
                                                <div class="form-group">
                                                    <label class="appointment-form-label">Select Time Slot</label>
                                                    <div class="time-slots-container">
                                                        @foreach ($availableSlots as $slot)
                                                        <label class="time-slot-option">
                                                            <input type="radio" wire:model.defer="form.appointment_time"
                                                                value="{{ $slot }}" name="appointment_time">
                                                            <span class="time-slot-btn">
                                                                {{ \Carbon\Carbon::parse($slot)->format('h:i A') }}
                                                            </span>
                                                        </label>
                                                        @endforeach
                                                    </div>
                                                    @error('form.appointment_time')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @endif

                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <textarea wire:model.defer="form.message"
                                                    placeholder="Message (Optional)"></textarea>
                                                @error('form.message')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group message-btn">
                                                <button type="submit" class="theme-btn btn-one"
                                                    wire:loading.attr="disabled" @if(!$isDoctorAvailable ||
                                                    empty($availableSlots)) disabled @endif>
                                                    <span wire:loading.remove>Book Appointment</span>
                                                    <span wire:loading>Booking...</span>
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