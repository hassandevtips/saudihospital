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
    {{-- Fixed Navigation Bullets (Right Side) --}}
    <div class="timeline-nav-bullets">
        @foreach($timelineItems as $index => $item)
        <a href="#section-{{ $item['id'] }}" class="nav-bullet {{ $index === 0 ? 'active' : '' }}"
            data-section="section-{{ $item['id'] }}" data-title="{{ $item['title'] }}">
            <span class="bullet-tooltip">{{ $item['title'] }}</span>
        </a>
        @endforeach
    </div>

    <div class="container">
        {{-- Main Story Section --}}
        <section id="main-story" class="timeline-section-item main-story">
            <div class="section-content text-center">
                <div class="timeline-vertical-line"></div>
                <h1 class="section-main-title text-center">{{ $page->title }}</h1>
                @if($page->content)
                <p class="section-main-subtitle text-center">{!!
                    strip_tags(html_entity_decode($page->getTranslation('content',
                    app()->getLocale()))) !!}</p>
                @endif
                <div class="timeline-vertical-line-bottom"></div>
            </div>
        </section>

        {{-- Timeline Items --}}
        @forelse($timelineItems as $index => $item)
        <section id="section-{{ $item['id'] }}" class="timeline-section-item" data-section="section-{{ $item['id'] }}">

            <div class="section-content">
                <div class="row align-items-center justify-content-center">
                    @if($item['featured_image'])
                    {{-- With Image Layout --}}
                    <div class="col-lg-5 {{ $index % 2 == 0 ? 'order-lg-1' : 'order-lg-2' }} mb-4 mb-lg-0">
                        <div class="timeline-image-wrapper">
                            <img src="{{ $item['featured_image'] }}" alt="{{ $item['title'] }}" class="timeline-image">
                        </div>
                    </div>
                    <div class="col-lg-5 {{ $index % 2 == 0 ? 'order-lg-2' : 'order-lg-1' }}">
                        <div class="timeline-text-content {{ $index % 2 == 0 ? 'text-lg-start' : 'text-lg-end' }}">
                            <h2 class="section-title text-center">{{ $item['title'] }}</h2>
                            <div class="section-text text-center">
                                {!! $item['content'] !!}
                            </div>
                        </div>
                    </div>
                    @else
                    {{-- Text Only Layout --}}
                    <div class="col-lg-8">
                        <div class="timeline-text-content text-center">
                            <h2 class="section-title text-center">{{ $item['title'] }}</h2>
                            <div class="section-text text-center">
                                {!! $item['content'] !!}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Vertical Line Connector --}}
                @if(!$loop->last)
                <div class="timeline-vertical-line-bottom"></div>
                @endif
            </div>
        </section>
        @empty
        <div class="alert alert-info text-center my-5">
            <h4 class="text-center">{{ gt('no_timeline_items_available', 'No timeline items available') }}</h4>
            <p class="text-center">{{ gt('please_add_child_pages_to_display_the_timeline', 'Please add child pages to
                display the timeline.') }}</p>
        </div>
        @endforelse
    </div>
</section>

<style>
    .text-center p {
        text-align: center !important;
    }

    /* Heritage Timeline Section */
    .heritage-timeline-section {
        padding: 0;
        position: relative;
        overflow: hidden;
    }

    /* Fixed Navigation Bullets (Right Side) */
    .timeline-nav-bullets {
        position: fixed;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 1000;
        display: flex;
        flex-direction: column;
        gap: 0;
    }

    .nav-bullet {
        position: relative;
        display: block;
        width: 16px;
        height: 16px;
        margin: 12px 0;
        text-decoration: none;
    }

    .nav-bullet::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(94, 179, 205, 0.3);
        border: 2px solid #5eb3cd;
        transition: all 0.3s ease;
    }

    .nav-bullet.active::before {
        background: #5eb3cd;
        box-shadow: 0 0 0 4px rgba(94, 179, 205, 0.2);
        transform: translate(-50%, -50%) scale(1.2);
    }

    .nav-bullet:hover::before {
        background: #5eb3cd;
        transform: translate(-50%, -50%) scale(1.3);
    }

    /* Connecting Line Between Bullets */
    .nav-bullet::after {
        content: '';
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 24px;
        background: rgba(94, 179, 205, 0.3);
    }

    .nav-bullet:last-child::after {
        display: none;
    }

    /* Tooltip on Hover */
    .bullet-tooltip {
        position: absolute;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(26, 77, 143, 0.95);
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        pointer-events: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .bullet-tooltip::after {
        content: '';
        position: absolute;
        right: -6px;
        top: 50%;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-left: 6px solid rgba(26, 77, 143, 0.95);
        border-top: 6px solid transparent;
        border-bottom: 6px solid transparent;
    }

    .nav-bullet:hover .bullet-tooltip {
        opacity: 1;
        visibility: visible;
        right: 35px;
    }

    /* Hide bullets on mobile */
    @media (max-width: 992px) {
        .timeline-nav-bullets {
            display: none;
        }
    }

    /* Timeline Section Items */
    .timeline-section-item {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px 0;
        position: relative;
    }

    .timeline-section-item.main-story {
        min-height: 80vh;
    }

    .section-content {
        width: 100%;
        position: relative;
        animation: fadeInUp 0.8s ease-out;
    }

    /* Vertical Timeline Line */
    .timeline-vertical-line {
        width: 3px;
        height: 200px;
        background: linear-gradient(180deg, transparent 0%, #5eb3cd 100%);
        margin: 0 auto 30px;
    }

    .timeline-vertical-line-bottom {
        width: 3px;
        height: 200px;
        background: linear-gradient(180deg, #5eb3cd 0%, #5eb3cd 100%);
        margin: 60px auto 0;
    }

    /* Main Story */
    .section-main-title {
        font-size: 4rem;
        font-weight: 700;
        color: #0098ac;
        margin-bottom: 1rem;
        line-height: 1.2;
        letter-spacing: -1px;
    }

    .section-main-subtitle {
        font-size: 20px;
        margin-bottom: 0;
        font-weight: 400;
        line-height: 1.4;
    }

    /* Section Titles */
    .section-title {
        font-size: 2.8rem;
        font-weight: 700;
        color: #f5a623;
        margin-bottom: 1.5rem;
        line-height: 1.3;
    }

    .section-text {
        font-size: 1.15rem;
        color: #555;
        line-height: 1.8;
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
        border-radius: 8px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        transition: all 0.4s ease;
    }

    .timeline-image-wrapper:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    .timeline-image {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.6s ease;
    }

    .timeline-image-wrapper:hover .timeline-image {
        transform: scale(1.05);
    }

    /* Timeline Text Content */
    .timeline-text-content {
        padding: 20px;
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
            font-size: 2.8rem;
        }

        .section-main-subtitle {
            font-size: 1.8rem;
        }

        .section-title {
            font-size: 2rem;
        }

        .section-text {
            font-size: 1rem;
        }

        .timeline-image-wrapper {
            margin-bottom: 30px;
        }

        .timeline-text-content {
            text-align: center !important;
        }

        .timeline-vertical-line,
        .timeline-vertical-line-bottom {
            height: 100px;
        }
    }

    @media (max-width: 768px) {
        .section-main-title {
            font-size: 2.2rem;
        }

        .section-main-subtitle {
            font-size: 1.5rem;
        }

        .section-title {
            font-size: 1.8rem;
        }

        .timeline-vertical-line,
        .timeline-vertical-line-bottom {
            height: 80px;
        }
    }

    /* Smooth Scrolling */
    html {
        scroll-behavior: smooth;
    }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navBullets = document.querySelectorAll('.nav-bullet');
        const sections = document.querySelectorAll('.timeline-section-item[data-section]');

        // Smooth scroll navigation - scroll to section with 10% offset from top
        navBullets.forEach(bullet => {
            bullet.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetSection = document.querySelector(targetId);

                if (targetSection) {
                    // Calculate position so section appears 10% from top of viewport
                    const sectionTop = targetSection.getBoundingClientRect().top + window.pageYOffset;
                    const windowHeight = window.innerHeight;
                    const offset = windowHeight * 0.2; // 10% from top

                    window.scrollTo({
                        top: sectionTop - offset,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Update active bullet on scroll
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '-20% 0px -20% 0px'
        };

        const sectionObserver = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const sectionId = entry.target.getAttribute('data-section');

                    // Remove active class from all bullets
                    navBullets.forEach(bullet => {
                        bullet.classList.remove('active');
                    });

                    // Add active class to current bullet
                    const activeBullet = document.querySelector(`.nav-bullet[data-section="${sectionId}"]`);
                    if (activeBullet) {
                        activeBullet.classList.add('active');
                    }
                }
            });
        }, observerOptions);

        sections.forEach(section => {
            sectionObserver.observe(section);
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
            rootMargin: '0px 0px 0px 0px'
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
