<section>
    {{-- Clinic Details Page --}}
    @include('livewire.includes.page-hero')

    <!-- clinic-details -->
    <section class="clinic-details sec-pad">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="service-sidebar mr_40">
                        <div class="text">
                            <h3>{{ gt('categories', 'Categories') }}</h3>
                        </div>
                        <ul class="category-list clearfix">
                            @forelse($clinics as $clinicItem)
                            <li><a @class([$clinicItem->slug == $clinic->slug ? 'current' : '']) wire:navigate
                                    href="{{ route('clinic.details', $clinicItem->slug) }}"
                                    class="{{ request()->is('clinic.details', $clinicItem->slug) ? 'current' : '' }}">{{
                                    $clinicItem->title
                                    }}</a></li>
                            @empty
                            <li><a href="#" style="color: #666;">{{ gt('no_clinics_available', 'No clinics available') }}</a></li>
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="clinic-details-content">
                        <div class="content-one mb_60">
                            @if($clinic->icon_image_url)
                            <figure class="image-box mb_40">
                                <img src="{{ $clinic->icon_image_url }}" alt="{{ $clinic->title }}">
                            </figure>
                            @endif
                            <div class="text-box">
                                <h2>{{ $clinic->title }}</h2>
                                <div class="description">
                                    {!! $clinic->full_description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- clinic-details end -->
</section>
