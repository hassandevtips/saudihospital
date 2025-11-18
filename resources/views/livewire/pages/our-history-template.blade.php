{{-- Our History Timeline Template --}}
@include('livewire.includes.page-hero')

{{-- Get child pages for timeline --}}
@php
$timelineItems = $page->activeChildren()->get()->map(function($child) {
return [
'id' => $child->id,
'title' => $child->getTranslation('title', app()->getLocale()),
'content' => $child->getTranslation('content', app()->getLocale()),
'slug' => $child->slug,
'featured_image' => $child->featured_image_url,
];
});
@endphp

<!-- Heritage Timeline Section -->
<section class="heritage-timeline-section">
    {{-- Vertical Timeline Dots Navigation (Right Side) --}}
    <div class="timeline-dots-nav d-none d-lg-block">
        @foreach($timelineItems as $index => $item)
        <a href="#section-{{ $item['id'] }}" class="timeline-dot {{ $index === 0 ? 'active' : '' }}"
            data-section="section-{{ $item['id'] }}" title="{{ $item['title'] }}">
        </a>
        @endforeach
    </div>

    <div class="container">
        {{-- Main Story Section with Quote --}}
        <section id="main-story" class="timeline-section-item main-story">
            <div class="section-content text-center">
                <h1 class="section-main-title">{{ $page->title }}</h1>
                @if($page->content)
                <div class="section-description">
                    {!! html_entity_decode($page->getTranslation('content', app()->getLocale())) !!}
                </div>
                @endif
                <div class="scroll-indicator-text mt-5">
                    <small>{{ __('Scroll') }}</small>
                    <div class="scroll-arrow"></div>
                </div>
            </div>
        </section>

        {{-- Timeline Items --}}
        @forelse($timelineItems as $index => $item)
        <section id="section-{{ $item['id'] }}"
            class="timeline-section-item {{ $index % 2 == 0 ? 'image-left' : 'image-right' }}"
            data-section="section-{{ $item['id'] }}">

            {{-- Section Header with Quote/Title --}}
            @if($index === 0 && $item['title'])
            <div class="section-quote-header text-center mb-5">
                <h2 class="quote-text">{{ $item['title'] }}</h2>
            </div>
            @endif

            <div class="section-content">
                <div class="row align-items-center">
                    @if($item['featured_image'])
                    {{-- With Image Layout --}}
                    <div class="col-lg-5 {{ $index % 2 == 0 ? 'order-1' : 'order-2' }} mb-4 mb-lg-0">
                        <div class="timeline-image-wrapper">
                            <img src="{{ $item['featured_image'] }}" alt="{{ $item['title'] }}" class="timeline-image">
                        </div>
                    </div>
                    <div class="col-lg-7 {{ $index % 2 == 0 ? 'order-2' : 'order-1' }}">
                        <div class="timeline-text-content">
                            <h2 class="section-title" style="color: #f7b731;">{{ $item['title'] }}</h2>
                            <h3 class="section-subtitle">{{ __('Founder (May he rest in peace)') }}</h3>
                            <div class="section-text">
                                {!! $item['content'] !!}
                            </div>
                        </div>
                    </div>
                    @else
                    {{-- Text Only Layout --}}
                    <div class="col-12">
                        <div class="timeline-text-content">
                            <h2 class="section-title">{{ $item['title'] }}</h2>
                            <div class="section-text">
                                {!! $item['content'] !!}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Vertical Line Connector --}}
            @if(!$loop->last)
            <div class="timeline-connector"></div>
            @endif
        </section>
        @empty
        <div class="alert alert-info text-center my-5">
            <h4>{{ __('No timeline items available') }}</h4>
            <p>{{ __('Please add child pages to display the timeline.') }}</p>
        </div>
        @endforelse
    </div>
</section>

<style>
    /* Heritage Timeline Section */
    .heritage-timeline-section {
        background: #f5f5f5;
        padding: 0;
        position: relative;
    }

    /* Vertical Timeline Dots Navigation (Right Side) */
    .timeline-dots-nav {
        position: fixed;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 1000;
        display: flex !important;
        flex-direction: column;
        gap: 20px;
    }

    .timeline-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #d1d1d1;
        border: 2px solid #d1d1d1;
        display: block;
        transition: all 0.3s ease;
        position: relative;
    }

    .timeline-dot:hover {
        background: #1a4d8f;
        border-color: #1a4d8f;
        transform: scale(1.3);
    }

    .timeline-dot.active {
        background: #1a4d8f;
        border-color: #1a4d8f;
        transform: scale(1.5);
    }

    .timeline-dot::before {
        content: '';
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 20px;
        background: #d1d1d1;
    }

    .timeline-dot:last-child::before {
        display: none;
    }

    /* Timeline Section Items */
    .timeline-section-item {
        min-height: 100vh;
        display: flex;
        align-items: center;
        padding: 100px 0;
        position: relative;
    }



    .section-content {
        width: 100%;
        animation: fadeInUp 0.8s ease-out;
    }

    /* Main Story */
    .section-main-title {
        font-size: 3.5rem;
        font-weight: 700;
        color: #1a4d8f;
        margin-bottom: 2rem;
        line-height: 1.2;
    }

    .section-description {
        font-size: 1.3rem;
        color: #555;
        line-height: 1.8;
        max-width: 900px;
        margin: 0 auto;
    }

    /* Scroll Indicator */
    .scroll-indicator-text {
        color: #1a4d8f;
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .scroll-arrow {
        width: 2px;
        height: 60px;
        background: linear-gradient(180deg, #1a4d8f 0%, transparent 100%);
        margin: 10px auto;
        animation: scrollDown 2s infinite;
    }

    @keyframes scrollDown {

        0%,
        100% {
            opacity: 0;
            transform: translateY(-20px);
        }

        50% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Quote Header */
    .section-quote-header {
        margin-bottom: 80px;
    }

    .quote-text {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1a4d8f;
        line-height: 1.4;
        max-width: 800px;
        margin: 0 auto;
        position: relative;
        padding: 30px 0;
    }

    .quote-text::before {
        content: '"';
        font-size: 6rem;
        color: #1a4d8f;
        opacity: 0.2;
        position: absolute;
        top: -20px;
        left: -40px;
    }

    /* Section Titles */
    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #f7b731;
        margin-bottom: 1rem;
        line-height: 1.3;
    }

    .section-subtitle {
        font-size: 1.3rem;
        color: #00b8d4;
        margin-bottom: 2rem;
        font-weight: 400;
    }

    .section-text {
        font-size: 1.1rem;
        color: #666;
        line-height: 1.9;
    }

    .section-text p {
        margin-bottom: 1.5rem;
    }

    .section-text ul,
    .section-text ol {
        padding-left: 2rem;
        margin-bottom: 1.5rem;
    }

    .section-text li {
        margin-bottom: 0.75rem;
    }

    /* Timeline Images */
    .timeline-image-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 0;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        transition: all 0.4s ease;
    }

    .timeline-image-wrapper:hover {
        transform: translateY(-15px);
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.2);
    }

    .timeline-image {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.6s ease;
    }

    .timeline-image-wrapper:hover .timeline-image {
        transform: scale(1.08);
    }

    /* Timeline Connector */
    .timeline-connector {
        width: 2px;
        height: 150px;
        background: linear-gradient(180deg, #1a4d8f 0%, transparent 100%);
        margin: 60px auto;
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(60px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Mobile Responsive */
    @media (max-width: 992px) {
        .timeline-section-item {
            min-height: auto;
            padding: 60px 0;
        }

        .section-main-title {
            font-size: 2.5rem;
        }

        .section-title {
            font-size: 2rem;
        }

        .quote-text {
            font-size: 1.8rem;
        }

        .section-description,
        .section-text {
            font-size: 1rem;
        }

        .timeline-dots-nav {
            display: none;
        }

        .timeline-image-wrapper {
            margin-bottom: 30px;
        }
    }

    @media (max-width: 768px) {
        .section-main-title {
            font-size: 2rem;
        }

        .section-title {
            font-size: 1.5rem;
        }

        .quote-text {
            font-size: 1.5rem;
        }

        .quote-text::before {
            font-size: 4rem;
            left: -20px;
        }
    }

    /* Smooth Scrolling */
    html {
        scroll-behavior: smooth;
    }

    /* Background Pattern */
    .heritage-timeline-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 100%;
        background:
            linear-gradient(90deg, rgba(26, 77, 143, 0.02) 1px, transparent 1px),
            linear-gradient(rgba(26, 77, 143, 0.02) 1px, transparent 1px);
        background-size: 50px 50px;
        pointer-events: none;
        opacity: 0.5;
    }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Scroll Spy for Timeline Dots
        const sections = document.querySelectorAll('.timeline-section-item[data-section]');
        const navDots = document.querySelectorAll('.timeline-dot');

        // Smooth scroll for navigation dots
        navDots.forEach(dot => {
            dot.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetSection = document.querySelector(targetId);

                if (targetSection) {
                    const offsetTop = targetSection.offsetTop - 80;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Update active dot on scroll
        const observerOptions = {
            threshold: 0.3,
            rootMargin: '-100px 0px -50% 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const sectionId = entry.target.getAttribute('data-section');

                    // Remove active class from all dots
                    navDots.forEach(dot => {
                        dot.classList.remove('active');
                    });

                    // Add active class to current dot
                    const activeDot = document.querySelector(`.timeline-dot[data-section="${sectionId}"]`);
                    if (activeDot) {
                        activeDot.classList.add('active');
                    }
                }
            });
        }, observerOptions);

        sections.forEach(section => {
            observer.observe(section);
        });

        // Fade in animation for sections
        const contentObserver = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        });

        const sectionContents = document.querySelectorAll('.section-content');
        sectionContents.forEach(content => {
            content.style.opacity = '0';
            content.style.transform = 'translateY(60px)';
            content.style.transition = 'opacity 0.8s ease-out, transform 0.8s ease-out';
            contentObserver.observe(content);
        });
    });
</script>
@endpush