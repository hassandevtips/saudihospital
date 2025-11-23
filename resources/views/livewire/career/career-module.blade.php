<div class="career-module">
    <div class="career-module__header">
        <h3>{{ gt('open_vacancies', 'Open Vacancies') }}</h3>
    </div>

    <div class="row clearfix">
        <div class="col-lg-7 col-md-12 col-sm-12">
            <div class="vacancy-list">
                @forelse ($vacancies as $vacancy)
                <article class="vacancy-card @if ($vacancy->id === $selectedVacancyId) is-active @endif"
                    wire:key="vacancy-{{ $vacancy->id }}" wire:click="selectVacancy({{ $vacancy->id }})">
                    <div class="vacancy-card__inner">
                        <div class="vacancy-card__header">
                            <h4>{{ $vacancy->title }}</h4>
                            @if ($vacancy->employment_type)
                            <span class="badge badge-light">{{ $vacancy->employment_type }}</span>
                            @endif
                        </div>

                        <ul class="vacancy-card__meta">
                            @if (!empty($vacancy->department))
                            <li>
                                <i class="icon-23"></i>
                                <span>{{ $vacancy->department }}</span>
                            </li>
                            @endif
                            @if (!empty($vacancy->location))
                            <li>
                                <i class="icon-27"></i>
                                <span>{{ $vacancy->location }}</span>
                            </li>
                            @endif
                            @if ($vacancy->closing_at)
                            <li>
                                <i class="icon-8"></i>
                                <span>{{ gt('apply_before', 'Apply before') }} {{ $vacancy->closing_at->translatedFormat('M d, Y')
                                    }}</span>
                            </li>
                            @endif
                        </ul>

                        @if (!empty($vacancy->summary))
                        <p class="vacancy-card__summary">
                            {{ \Illuminate\Support\Str::limit(strip_tags($vacancy->summary), 180) }}
                        </p>
                        @endif

                        <button class="theme-btn btn-two vacancy-card__link" type="button">
                            {{ gt('view_details', 'View Details') }}
                        </button>
                    </div>
                </article>
                @empty
                <div class="empty-state centred">
                    <p>{{ gt('no_vacancies_available', 'No vacancies are available right now. Please check back soon.') }}</p>
                </div>
                @endforelse
            </div>
        </div>

        <div class="col-lg-5 col-md-12 col-sm-12">
            <div class="career-form-wrapper contact-form-area">
                <div class="career-form-wrapper__header">
                    <h4>{{ gt('apply_now', 'Apply Now') }}</h4>
                    @if ($selectedVacancy)
                    <p class="career-form-wrapper__subtitle">
                        {{ gt('you_are_applying_for', 'You are applying for:') }}
                        <strong>{{ $selectedVacancy->title }}</strong>
                    </p>
                    @endif
                </div>

                @if (session()->has('career_success'))
                <div class="alert alert-success">
                    {{ session('career_success') }}
                </div>
                @endif

                <form wire:submit.prevent="submit" class="contact-form">
                    <div class="form-group">
                        <select wire:model="selectedVacancyId" class="custom-select" required>
                            <option value="">{{ gt('select_vacancy', 'Select a vacancy') }}</option>
                            @foreach ($vacancies as $vacancy)
                            <option value="{{ $vacancy->id }}">{{ $vacancy->title }}</option>
                            @endforeach
                        </select>
                        @error('selectedVacancyId')
                        <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <input type="text" wire:model.defer="form.name" placeholder="{{ gt('your_name', 'Your Name') }}"
                                required>
                            @error('form.name')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <input type="email" wire:model.defer="form.email" placeholder="{{ gt('email_address', 'Email Address') }}"
                                required>
                            @error('form.email')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <input type="text" wire:model.defer="form.phone" placeholder="{{ gt('phone_number', 'Phone Number') }}">
                            @error('form.phone')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <input type="text" wire:model.defer="form.current_position"
                                placeholder="{{ gt('current_position_optional', 'Current Position (optional)') }}">
                            @error('form.current_position')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <input type="url" wire:model.defer="form.resume_url"
                                placeholder="{{ gt('cv_url_optional', 'Online CV / Portfolio URL (optional)') }}">
                            @error('form.resume_url')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <textarea wire:model.defer="form.cover_letter"
                                placeholder="{{ gt('cover_letter_message', 'Cover Letter or Message') }}"></textarea>
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
        </div>
    </div>

    @if ($selectedVacancy)
    <div class="vacancy-details p_relative">
        <div class="vacancy-details__header">
            <h3>{{ $selectedVacancy->title }}</h3>
        </div>

        <ul class="vacancy-details__meta">
            @if (!empty($selectedVacancy->department))
            <li>
                <strong>{{ gt('department', 'Department') }}:</strong>
                <span>{{ $selectedVacancy->department }}</span>
            </li>
            @endif

            @if (!empty($selectedVacancy->location))
            <li>
                <strong>{{ gt('location', 'Location') }}:</strong>
                <span>{{ $selectedVacancy->location }}</span>
            </li>
            @endif

            @if ($selectedVacancy->employment_type)
            <li>
                <strong>{{ gt('employment_type', 'Employment Type') }}:</strong>
                <span>{{ $selectedVacancy->employment_type }}</span>
            </li>
            @endif

            @if ($selectedVacancy->posted_at)
            <li>
                <strong>{{ gt('posted_on', 'Posted on') }}:</strong>
                <span>{{ $selectedVacancy->posted_at->translatedFormat('M d, Y') }}</span>
            </li>
            @endif

            @if ($selectedVacancy->closing_at)
            <li>
                <strong>{{ gt('closes_on', 'Closes on') }}:</strong>
                <span>{{ $selectedVacancy->closing_at->translatedFormat('M d, Y') }}</span>
            </li>
            @endif
        </ul>

        @if (!empty($selectedVacancy->summary))
        <div class="vacancy-details__summary">
            <h4>{{ gt('role_overview', 'Role Overview') }}</h4>
            <p>{!! nl2br(e($selectedVacancy->summary)) !!}</p>
        </div>
        @endif

        @if (!empty($selectedVacancy->description))
        <div class="vacancy-details__description">
            <h4>{{ gt('responsibilities', 'Responsibilities') }}</h4>
            <p>{!! nl2br(e($selectedVacancy->description)) !!}</p>
        </div>
        @endif

        @php
        $requirements = [];

        if (!empty($selectedVacancy->requirements)) {
        $requirements = is_array($selectedVacancy->requirements)
        ? $selectedVacancy->requirements
        : preg_split('/\r\n|\r|\n/', (string) $selectedVacancy->requirements);
        }
        @endphp

        @if (!empty($requirements))
        <div class="vacancy-details__requirements">
            <h4>{{ gt('requirements', 'Requirements') }}</h4>
            <ul class="list-style-one">
                @foreach ($requirements as $requirement)
                @if (filled($requirement))
                <li>{{ strip_tags($requirement) }}</li>
                @endif
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    @endif
</div>