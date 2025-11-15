@include('livewire.includes.page-hero')

<section class="service-details p_relative">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                @include('livewire.includes.left-menu')
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">

                <livewire:pregnancy-calculator />

            </div>
        </div>
    </div>
</section>
