{{-- Our History Timeline Template --}}
@include('livewire.includes.page-hero')

{{-- Get menu items for this page --}}
@php
$menuItemsParent = \App\Models\MenuItem::where('url', $page->slug)->first();
$menuItems = [];

if ($menuItemsParent) {
// Get children menu items
$menuItems = $menuItemsParent->children()->get();

// If no children, get siblings
if ($menuItems->isEmpty() && $menuItemsParent->parent) {
$menuItems = $menuItemsParent->parent->children()->get();
}
}

// Fetch page content for each menu item
$timelineItems = [];
foreach ($menuItems as $menuItem) {
$itemPage = \App\Models\Page::where('slug', $menuItem->url)
->where('is_active', true)
->first();

if ($itemPage) {
$timelineItems[] = [
'title' => $menuItem->getTranslation('title', app()->getLocale()),
'content' => $itemPage->content,
'url' => $menuItem->url,
];
}
}
@endphp

<!-- Timeline Section -->
<section class="timeline-section p_relative py-5">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="sec-title text-center mb-5">
                    <h2>{{ $page->title }}</h2>
                    @if($page->content)
                    <div class="text mt-3">
                        {!! html_entity_decode($page->content) !!}
                    </div>
                    @endif
                </div>

                {{-- Timeline Container --}}
                <div class="timeline-container position-relative">
                    @forelse($timelineItems as $index => $item)
                    <div class="timeline-item mb-5 position-relative" data-aos="fade-up"
                        data-aos-delay="{{ $index * 100 }}">
                        <div class="row align-items-center">
                            {{-- Content on Left --}}
                            <div class="col-lg-5 col-md-5 {{ $index % 2 == 0 ? 'order-1' : 'order-1 order-md-2' }}">
                                <div class="timeline-content p-4 bg-white shadow-sm rounded">
                                    <h3 class="timeline-title mb-3" style="color: #1a4d8f;">
                                        @if(is_array($item['title']))
                                        {{ collect($item['title'])->flatten()->filter()->first() ?? '' }}
                                        @else
                                        {{ $item['title'] }}
                                        @endif
                                    </h3>
                                    <div class="timeline-text">
                                        @if(is_array($item['content']))
                                        {!! html_entity_decode(collect($item['content'])->flatten()->filter()->first()
                                        ?? '') !!}
                                        @else
                                        {!! html_entity_decode($item['content']) !!}
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Center Line with Bullet --}}
                            <div
                                class="col-lg-2 col-md-2 {{ $index % 2 == 0 ? 'order-2' : 'order-2 order-md-1' }} text-center">
                                <div class="timeline-marker position-relative d-inline-block">
                                    <div class="timeline-bullet" style="
                                            width: 24px;
                                            height: 24px;
                                            background: #1a4d8f;
                                            border: 4px solid #fff;
                                            border-radius: 50%;
                                            box-shadow: 0 0 0 4px rgba(26, 77, 143, 0.2);
                                            position: relative;
                                            z-index: 2;
                                        "></div>
                                    @if(!$loop->last)
                                    <div class="timeline-line" style="
                                                position: absolute;
                                                top: 24px;
                                                left: 50%;
                                                transform: translateX(-50%);
                                                width: 2px;
                                                height: 100px;
                                                background: linear-gradient(180deg, #1a4d8f 0%, rgba(26, 77, 143, 0.3) 100%);
                                            "></div>
                                    @endif
                                </div>
                            </div>

                            {{-- Empty Space on Right --}}
                            <div class="col-lg-5 col-md-5 {{ $index % 2 == 0 ? 'order-3' : 'order-3 order-md-3' }}">
                                {{-- Empty column for alternating layout --}}
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="alert alert-info text-center">
                        <h4>No timeline items available</h4>
                        <p>Please add menu items and associated pages to display the timeline.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .timeline-section {
        background: #f8f9fa;
    }

    .timeline-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 0;
    }

    .timeline-item {
        margin-bottom: 4rem !important;
    }

    .timeline-content {
        transition: all 0.3s ease;
        border-left: 4px solid #1a4d8f;
    }

    .timeline-content:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
    }

    .timeline-title {
        font-size: 1.5rem;
        font-weight: 600;
    }

    .timeline-text {
        color: #666;
        line-height: 1.8;
    }

    .timeline-text p {
        margin-bottom: 1rem;
    }

    .timeline-text ul,
    .timeline-text ol {
        padding-left: 1.5rem;
        margin-bottom: 1rem;
    }

    .timeline-marker {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100px;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .timeline-item .row {
            flex-direction: column;
        }

        .timeline-item .col-md-5,
        .timeline-item .col-md-2 {
            order: initial !important;
        }

        .timeline-marker {
            margin: 1rem 0;
        }

        .timeline-line {
            height: 50px !important;
        }
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .timeline-item {
        animation: fadeInUp 0.6s ease-out;
    }
</style>

{{-- Optional: Add AOS (Animate On Scroll) library if not already included --}}
@push('scripts')
<script>
    // Simple scroll animation fallback if AOS is not available
    document.addEventListener('DOMContentLoaded', function() {
        const timelineItems = document.querySelectorAll('.timeline-item');

        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        timelineItems.forEach(item => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(30px)';
            item.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
            observer.observe(item);
        });
    });
</script>
@endpush
