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
                                <li><span>{{ gt('occupation', 'Occupation') }}:</span>{{ $doctor->department->name }}
                                </li>
                                @if($doctor->location)
                                <li><span>{{ gt('location', 'Location') }}:</span><a
                                        href="{{ url('working-hours') }}">{{
                                        $doctor->location->name }}</a></li>
                                @endif
                                <li><span>{{ gt('phone', 'Phone') }}:</span><a class="dltr"
                                        href=" tel:{{ $doctor->phone }}">{{
                                        $doctor->phone }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="skills-box">
                            <div class="text">
                                <h3>{{ gt('my_skills', 'My Skills') }}</h3>
                                <p>{!! $doctor->skills !!}</p>
                            </div>
                        </div>

                        {{-- Success/Error Messages --}}
                        @if (session()->has('appointment_success'))
                        <div class="alert alert-success mb-3">
                            <strong>✓ {{ gt('success', 'Success') }}!</strong> {{ session('appointment_success') }}
                        </div>
                        @endif

                        @if (session()->has('appointment_error'))
                        <div class="alert alert-danger mb-3">
                            <strong>✗ {{ gt('error', 'Error') }}!</strong> {{ session('appointment_error') }}
                        </div>
                        @endif

                        {{-- Book Appointment Button --}}
                        <div class="appointment-cta-section">
                            <button type="button" class="theme-btn btn-one" wire:click="openModal">
                                <i class="icon-calendar"></i> {{ gt('book_appointment_24_7', 'Book Appointment') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- team-details end -->

    {{-- Appointment Booking Modal --}}
    @if($showModal)
    <div id="appointmentModal" class="appointment-modal active">
        <div class="appointment-modal-overlay" wire:click="closeModal"></div>
        <div class="appointment-modal-content">
            <div class="appointment-modal-header">
                <h3>{{ gt('book_appointment_with', 'Book an Appointment with') }} {{ $doctor->name }}</h3>
                <button type="button" class="modal-close-btn" wire:click="closeModal">&times;</button>
            </div>

            {{-- Error Messages (only show errors in modal) --}}
            @if (session()->has('appointment_error'))
            <div class="alert alert-danger appointment-alert">
                <strong>✗ {{ gt('error', 'Error') }}!</strong> {{ session('appointment_error') }}
            </div>
            @endif

            {{-- Progress Steps --}}
            <div class="appointment-steps">
                <div class="step {{ $currentStep >= 1 ? 'active' : '' }} {{ $currentStep > 1 ? 'completed' : '' }}">
                    <div class="step-number">1</div>
                    <div class="step-label">{{ gt('select_date', 'Select Date') }}</div>
                </div>
                <div class="step {{ $currentStep >= 2 ? 'active' : '' }} {{ $currentStep > 2 ? 'completed' : '' }}">
                    <div class="step-number">2</div>
                    <div class="step-label">{{ gt('choose_time', 'Choose Time') }}</div>
                </div>
                <div class="step {{ $currentStep >= 3 ? 'active' : '' }} {{ $currentStep > 3 ? 'completed' : '' }}">
                    <div class="step-number">3</div>
                    <div class="step-label">{{ gt('your_details', 'Your Details') }}</div>
                </div>
                <div class="step {{ $currentStep >= 4 ? 'active' : '' }}">
                    <div class="step-number">4</div>
                    <div class="step-label">{{ gt('confirm', 'Confirm') }}</div>
                </div>
            </div>

            <div class="appointment-modal-body">
                <form wire:submit.prevent="submitAppointment" id="appointmentForm">

                    {{-- Step 1: Select Date --}}
                    @if($currentStep === 1)
                    <div class="appointment-step-content">
                        <h4>{{ gt('select_appointment_date', 'Select Appointment Date') }}</h4>
                        <p class="step-description">{{ gt('choose_date_for_appointment', 'Choose a date for your
                            appointment with') }} {{ gt('dr', 'Dr.') }} {{ $doctor->name }}</p>

                        <div class="form-group">
                            <label class="appointment-form-label">{{ gt('appointment_date', 'Appointment Date') }}
                                *</label>
                            <input class="form-control appointment-date-input" type="date"
                                wire:model.live="form.appointment_date" min="{{ date('Y-m-d') }}" required>
                            @error('form.appointment_date')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="step-actions">
                            <button type="button" class="btn-secondary" wire:click="closeModal">{{ gt('cancel',
                                'Cancel') }}</button>
                            <button type="button" class="btn-primary" wire:click="nextStep"
                                @disabled(!$this->canProceedToNextStep())>
                                {{ gt('next_choose_time', 'Next: Choose Time') }}
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Step 2: Select Time Slot --}}
                    @if($currentStep === 2)
                    <div class="appointment-step-content">
                        <h4>{{ gt('select_time_slot', 'Select Time Slot') }}</h4>
                        <p class="step-description">{{ gt('choose_preferred_time', 'Choose your preferred appointment
                            time') }}</p>

                        <div wire:loading wire:target="form.appointment_date" class="time-slots-loading">
                            {{ gt('loading_time_slots', 'Loading available time slots') }}
                        </div>

                        <div wire:loading.remove wire:target="form.appointment_date">
                            @if (!$isDoctorAvailable)
                            <div class="availability-alert warning">
                                <strong>⚠️ {{ gt('doctor_not_available', 'Doctor Not Available') }}</strong>
                                <p>{{ gt('doctor_not_available_day', 'The doctor is not available on this day. Please go
                                    back and select another date.') }}</p>
                            </div>
                            @elseif (empty($availableSlots))
                            <div class="availability-alert info">
                                <strong>ℹ️ {{ gt('all_slots_booked', 'All Slots Booked') }}</strong>
                                <p>{{ gt('all_slots_booked_desc', 'All appointment slots are fully booked for this date.
                                    Please select another date.') }}</p>
                            </div>
                            @else
                            <div class="form-group">
                                <label class="appointment-form-label">{{ gt('available_time_slots', 'Available Time
                                    Slots') }} *</label>
                                <div class="time-slots-container">
                                    @foreach ($availableSlots as $slot)
                                    <label class="time-slot-option">
                                        <input type="radio" wire:model.live="form.appointment_time" value="{{ $slot }}"
                                            name="appointment_time" required>
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

                        <div class="step-actions">
                            <button type="button" class="btn-secondary" wire:click="prevStep">{{ gt('back', 'Back')
                                }}</button>
                            <button type="button" class="btn-primary" wire:click="nextStep"
                                @disabled(!$this->canProceedToNextStep())>
                                {{ gt('next_your_details', 'Next: Your Details') }}
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Step 3: Patient Details --}}
                    @if($currentStep === 3)
                    <div class="appointment-step-content">
                        <h4>{{ gt('your_contact_info', 'Your Contact Information') }}</h4>
                        <p class="step-description">{{ gt('provide_contact_details', 'Please provide your contact
                            details') }}</p>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="appointment-form-label">{{ gt('full_name', 'Full Name') }} *</label>
                                    <input type="text" class="form-control" wire:model.live="form.patient_name"
                                        placeholder="{{ gt('enter_full_name', 'Enter your full name') }}" required>
                                    @error('form.patient_name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="appointment-form-label">{{ gt('email_address', 'Email Address') }}
                                        *</label>
                                    <input type="email" class="form-control" wire:model.live="form.patient_email"
                                        placeholder="{{ gt('email_placeholder', 'your.email@example.com') }}" required>
                                    @error('form.patient_email')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="appointment-form-label">{{ gt('phone_number', 'Phone Number') }}
                                        *</label>
                                    <input type="tel" class="form-control" wire:model.live="form.patient_phone"
                                        placeholder="{{ gt('phone_placeholder', '+966 XXX XXX XXX') }}" required>
                                    @error('form.patient_phone')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="appointment-form-label">{{ gt('message_optional', 'Message
                                        (Optional)') }}</label>
                                    <textarea class="form-control" wire:model.live="form.message" rows="4"
                                        placeholder="{{ gt('additional_info_placeholder', 'Any additional information or special requests...') }}"></textarea>
                                    @error('form.message')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="step-actions">
                            <button type="button" class="btn-secondary" wire:click="prevStep">{{ gt('back', 'Back')
                                }}</button>
                            <button type="button" class="btn-primary" wire:click="nextStep"
                                @disabled(!$this->canProceedToNextStep())>
                                {{ gt('next_review_confirm', 'Next: Review & Confirm') }}
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- Step 4: Confirmation --}}
                    @if($currentStep === 4)
                    <div class="appointment-step-content">
                        <h4>{{ gt('review_appointment', 'Review Your Appointment') }}</h4>
                        <p class="step-description">{{ gt('review_before_confirm', 'Please review your appointment
                            details before confirming') }}</p>

                        <div class="appointment-summary">
                            <div class="summary-section">
                                <h5><i class="icon-user"></i> {{ gt('doctor_information', 'Doctor Information') }}</h5>
                                <div class="summary-item">
                                    <strong>{{ gt('doctor', 'Doctor') }}:</strong> {{ $doctor->name }}
                                </div>
                                <div class="summary-item">
                                    <strong>{{ gt('specialization', 'Specialization') }}:</strong> {{
                                    $doctor->specialization }}
                                </div>
                                <div class="summary-item">
                                    <strong>{{ gt('department', 'Department') }}:</strong> {{ $doctor->department->name
                                    }}
                                </div>
                                @if($doctor->location)
                                <div class="summary-item">
                                    <strong>{{ gt('location', 'Location') }}:</strong> {{ $doctor->location->name }}
                                </div>
                                @endif
                            </div>

                            <div class="summary-section">
                                <h5><i class="icon-calendar"></i> {{ gt('appointment_details', 'Appointment Details') }}
                                </h5>
                                <div class="summary-item">
                                    <strong>{{ gt('date', 'Date') }}:</strong>
                                    <span>
                                        {{ !empty($form['appointment_date']) ?
                                        \Carbon\Carbon::parse($form['appointment_date'])->format('l, F j, Y') :
                                        gt('not_selected', 'Not selected') }}
                                    </span>
                                </div>
                                <div class="summary-item">
                                    <strong>{{ gt('time', 'Time') }}:</strong>
                                    <span>
                                        {{ !empty($form['appointment_time']) ?
                                        \Carbon\Carbon::parse($form['appointment_time'])->format('h:i A') :
                                        gt('not_selected', 'Not selected') }}
                                    </span>
                                </div>
                            </div>

                            <div class="summary-section">
                                <h5><i class="icon-phone"></i> {{ gt('your_information', 'Your Information') }}</h5>
                                <div class="summary-item">
                                    <strong>{{ gt('name', 'Name') }}:</strong> <span>{{ $form['patient_name'] ??
                                        gt('not_provided', 'Not provided') }}</span>
                                </div>
                                <div class="summary-item">
                                    <strong>{{ gt('email', 'Email') }}:</strong> <span>{{ $form['patient_email'] ??
                                        gt('not_provided', 'Not provided') }}</span>
                                </div>
                                <div class="summary-item">
                                    <strong>{{ gt('phone', 'Phone') }}:</strong> <span>{{ $form['patient_phone'] ??
                                        gt('not_provided', 'Not provided') }}</span>
                                </div>
                                @if(!empty($form['message']))
                                <div class="summary-item">
                                    <strong>{{ gt('message', 'Message') }}:</strong>
                                    <p class="message-preview">{{ $form['message'] }}</p>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="step-actions">
                            <button type="button" class="btn-secondary" wire:click="prevStep">{{ gt('back', 'Back')
                                }}</button>
                            <button type="submit" class="btn-success" wire:loading.attr="disabled">
                                <span wire:loading.remove><i class="icon-check"></i> {{ gt('confirm_appointment',
                                    'Confirm Appointment') }}</span>
                                <span wire:loading>{{ gt('booking', 'Booking...') }}</span>
                            </button>
                        </div>
                    </div>
                    @endif

                </form>
            </div>
        </div>
    </div>
    @endif

</section>
