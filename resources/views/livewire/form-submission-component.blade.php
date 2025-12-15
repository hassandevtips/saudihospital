<section>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/career-module.css') }}">
    <style>
        .form-type-badge {
            display: inline-block;
            padding: 8px 16px;
            background: #00a3e0;
            color: white;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        /* Date Picker Styling */
        .contact-form input[type="date"] {
            position: relative;
            width: 100%;
            height: 60px;
            background-color: #ffffff;
            border: 1px solid #e1e1e1;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            color: #222222;
            transition: all 500ms ease;
            font-family: inherit;
        }

        .contact-form input[type="date"]:focus {
            border-color: #00a3e0;
            outline: none;
        }

        .contact-form input[type="date"]::-webkit-calendar-picker-indicator {
            cursor: pointer;
            opacity: 0.6;
            filter: invert(0.5);
        }

        .contact-form input[type="date"]::-webkit-calendar-picker-indicator:hover {
            opacity: 1;
        }

        /* Select Dropdown Styling */
        .contact-form select,
        .contact-form .form-control {
            position: relative;
            width: 100%;
            height: 60px;
            background-color: #ffffff;
            border: 1px solid #e1e1e1;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            color: #222222;
            transition: all 500ms ease;
            font-family: inherit;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23222222' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 20px;
            padding-right: 45px;
            line-height: 1.5;
            cursor: pointer;
        }

        .contact-form select:focus,
        .contact-form .form-control:focus {
            border-color: #00a3e0;
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 163, 224, 0.1);
        }

        .contact-form select option {
            padding: 12px;
            background-color: #ffffff;
            color: #222222;
            font-size: 16px;
            line-height: 1.5;
        }

        /* Placeholder color for select */
        .contact-form select:invalid {
            color: #777777;
        }

        .contact-form select option:first-child {
            color: #999999;
        }

        .contact-form select:valid {
            color: #222222;
        }

        /* Fix for select dropdown in different browsers */
        .contact-form select::-ms-expand {
            display: none;
        }

        /* Ensure proper spacing and no text overlap */
        .contact-form .form-group select {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Form text helper */
        .form-text {
            display: block;
            margin-top: 5px;
            font-size: 13px;
            line-height: 1.5;
        }

        .text-muted {
            color: #6c757d;
        }
    </style>
    @endpush

    @include('livewire.includes.page-hero');

    <!-- form-submission-section -->
    <section class="service-details p_relative">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    @include('livewire.includes.left-menu', ['static_menu_id' => '58'])
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="service-details-content">

                        <!-- Form Header -->
                        <section class="about-section">
                            <div class="auto-container">
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12 content-column">
                                        <div class="content_block_one">
                                            <div class="content-box ml_30">
                                                <div class="sec-title left p_relative d_block mb_25">

                                                    <h2>{{ gt('application_form', 'Application Form') }}</h2>
                                                    <p>{{ gt('application_form_description', 'Please fill out the form
                                                        below to submit your application.
                                                        All fields marked with * are required.') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Application Form -->
                        <div class="application-form-section contact-style-two p_relative">
                            <div class="application-form-wrapper form-inner">

                                @if (session()->has('form_success'))
                                <div class="alert alert-success"
                                    style="padding: 15px; background: #d4edda; border: 1px solid #c3e6cb; border-radius: 4px; margin-bottom: 20px; color: #155724;">
                                    <strong>{{ gt('success', 'Success!') }}</strong> {{ session('form_success') }}
                                </div>
                                @endif

                                <form wire:submit.prevent="submit" class="contact-form">
                                    <div class="row clearfix">

                                        <!-- Personal Information Section -->
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <h4 style="margin-bottom: 20px; color: #00a3e0;">{{
                                                gt('personal_information', 'Personal
                                                Information') }}</h4>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <input type="text" wire:model.defer="form.name"
                                                placeholder="{{ gt('full_name', 'Full Name') }} *" required>
                                            @error('form.name')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <input type="email" wire:model.defer="form.email"
                                                placeholder="{{ gt('email_address', 'Email Address') }} *" required>
                                            @error('form.email')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <input type="text" wire:model.defer="form.phone"
                                                placeholder="{{ gt('phone_number', 'Phone Number') }}">
                                            @error('form.phone')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <input type="text" wire:model.defer="form.national_id"
                                                placeholder="{{ gt('national_id_passport', 'National ID / Passport') }}">
                                            @error('form.national_id')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <input type="date" wire:model.defer="form.date_of_birth"
                                                placeholder="{{ gt('date_of_birth', 'Date of Birth') }}">
                                            @error('form.date_of_birth')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <input type="text" wire:model.defer="form.current_position"
                                                placeholder="{{ gt('current_position_occupation', 'Current Position / Occupation') }}">
                                            @error('form.current_position')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Educational Background Section -->
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <h4 style="margin: 30px 0 20px; color: #00a3e0;">{{
                                                gt('educational_background', 'Educational
                                                Background') }}</h4>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <select wire:model.defer="form.education_level" class="form-control">
                                                <option value="">{{ gt('select_education_level', 'Select Education
                                                    Level') }}</option>
                                                @foreach($educationLevels as $key => $label)
                                                <option value="{{ $key }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                            @error('form.education_level')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <input type="text" wire:model.defer="form.university"
                                                placeholder="{{ gt('university_institution', 'University / Institution') }}">
                                            @error('form.university')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <input type="text" wire:model.defer="form.major"
                                                placeholder="{{ gt('major_field_of_study', 'Major / Field of Study') }}">
                                            @error('form.major')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Application Materials Section -->
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <h4 style="margin: 30px 0 20px; color: #00a3e0;">{{
                                                gt('application_materials', 'Application Materials') }}</h4>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <label>{{ gt('resume_upload_label', 'Upload Resume/CV (PDF, DOC, DOCX, or Image)') }}</label>
                                            <input type="file" wire:model="form.resume_file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif">
                                            <div wire:loading wire:target="form.resume_file" class="mt-2">
                                                <small class="text-info">{{ gt('uploading', 'Uploading...') }}</small>
                                            </div>
                                            @error('form.resume_file')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                            @if(!empty($form['resume_file']))
                                            <div class="mt-2">
                                                <small class="text-success">{{ gt('file_selected', 'File selected') }}: {{
                                                    $form['resume_file']->getClientOriginalName() }}</small>
                                            </div>
                                            @endif
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <input type="url" wire:model.defer="form.resume_url"
                                                placeholder="{{ gt('resume_cv_url', 'Or provide Resume/CV URL (LinkedIn, Google Drive, Dropbox, etc.)') }}">
                                            <small class="form-text text-muted">{{ gt('resume_cv_url_description',
                                                'You can upload a file above or provide a link to your resume or CV') }}</small>
                                            @error('form.resume_url')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <textarea wire:model.defer="form.cover_letter"
                                                placeholder="{{ gt('cover_letter', 'Cover Letter') }}"
                                                rows="6"></textarea>
                                            <small class="form-text text-muted">{{ gt('this_opportunity', 'Tell us why
                                                you are interested in this opportunity')
                                                }}</small>
                                            @error('form.cover_letter')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <textarea wire:model.defer="form.message"
                                                placeholder="{{ gt('additional_message_optional', 'Additional Message (Optional)') }}"
                                                rows="4"></textarea>
                                            @error('form.message')
                                            <span class="error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn mr-0 centred">
                                            <button class="theme-btn btn-one" type="submit"
                                                wire:loading.attr="disabled">
                                                <span wire:loading.remove wire:target="submit">{{
                                                    gt('submit_application', 'Submit
                                                    Application') }}</span>
                                                <span wire:loading wire:target="submit">{{ gt('submitting',
                                                    'Submitting...') }}</span>
                                            </button>
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
    <!-- form-submission-section end -->

</section>
