@include('livewire.includes.page-hero');

<!-- faq-page-section -->
<section class="faq-page-section p_relative">
    <div class="pattern-layer">
        <div class="pattern-1" style="background-image: url(assets/images/shape/shape-52.png);"></div>
        <div class="pattern-2" style="background-image: url(assets/images/shape/shape-53.png);"></div>
    </div>
    <div class="auto-container">
        @php
        $faqs = collect($faqs ?? []);
        @endphp

        <div class="title-text centred mb_50">
            <h2 class="fs_30 lh_40 fw_bold">{{ $page->title ?? gt('frequently_asked_questions', 'Frequently Asked Questions') }}</h2>

        </div>

        <div class="inner-box">
            @if($faqs->isNotEmpty())
            <ul class="accordion-box">
                @foreach($faqs as $faq)
                @php
                $isActive = $loop->first;
                @endphp
                <li class="accordion block {{ $isActive ? 'active-block' : '' }}" wire:key="faq-{{ $faq->id }}">
                    <div class="acc-btn {{ $isActive ? 'active' : '' }}"
                        aria-expanded="{{ $isActive ? 'true' : 'false' }}">
                        <div class="icon-outer"><i class="far fa-angle-down"></i></div>
                        <h4>{{ $faq->question }}</h4>
                        @if(filled($faq->category))
                        <span class="faq-category ms_15">{{ $faq->category }}</span>
                        @endif
                    </div>
                    <div class="acc-content {{ $isActive ? 'current' : '' }}">
                        <div class="text">
                            @if(filled($faq->answer))
                            {!! $faq->answer !!}
                            @else
                            <p>{{ gt('details_available_soon', 'Details will be available soon.') }}</p>
                            @endif
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
            @else
            <p class="text-center fs_18">{{ gt('faq_available_soon', 'FAQ entries will be available soon.') }}</p>
            @endif
        </div>
    </div>
</section>
<!-- faq-page-section end -->