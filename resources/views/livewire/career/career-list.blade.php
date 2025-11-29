<div class="career-list">
    <div class="career-list__header">
        <h3>{{ gt('open_vacancies', 'Open Vacancies') }}</h3>
        <p>{{ gt('explore_job_openings', 'Explore our current job openings and join our team') }}</p>
    </div>

    <div class="vacancy-grid">
        @forelse ($vacancies as $vacancy)
        <article class="vacancy-card" wire:key="vacancy-{{ $vacancy->id }}">
            <div class="vacancy-card__inner">
                <div class="vacancy-card__header">
                    <h4>{{ $vacancy->title }}</h4>
                    @if ($vacancy->employment_type)
                    <span class="badge badge-primary">{{ $vacancy->employment_type }}</span>
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
                        <span>{{ gt('apply_before', 'Apply before') }} {{ $vacancy->closing_at->translatedFormat('M d,
                            Y') }}</span>
                    </li>
                    @endif
                </ul>

                @if (!empty($vacancy->summary))
                <p class="vacancy-card__summary">
                    {{ \Illuminate\Support\Str::limit(strip_tags($vacancy->summary), 180) }}
                </p>
                @endif

                <a href="{{ url('/careers/' . $vacancy->slug) }}" wire:navigate
                    class="theme-btn btn-two vacancy-card__link">
                    {{ gt('view_details_apply', 'View Details & Apply') }}
                </a>
            </div>
        </article>
        @empty
        <div class="empty-state centred">
            <p>{{ gt('no_vacancies_available', 'No vacancies are available right now. Please check back soon.') }}</p>
        </div>
        @endforelse
    </div>
</div>
