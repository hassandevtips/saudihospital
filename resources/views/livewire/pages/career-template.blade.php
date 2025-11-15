<section>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/career-module.css') }}">
    @endpush

    @include('livewire.includes.page-hero');


    <!-- service-details -->
    <section class="service-details p_relative">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    @include('livewire.includes.left-menu')
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="service-details-content">

                        <div class="content-two">
                            @livewire('career.career-list')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- service-details end -->

</section>