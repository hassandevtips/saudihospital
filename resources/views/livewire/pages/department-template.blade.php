<section>
    {{-- Doctor Template Page --}}
    @include('livewire.includes.page-hero');


    <!-- service-style-two -->
    <section class="service-page-section p_relative">
        <div class="auto-container">
            <div class="row clearfix">
                @forelse($departments as $department)
                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-one wow fadeInUp animated" data-wow-delay="00ms"
                        data-wow-duration="1500ms">
                        <div class="inner-box">
                            <figure class="image-box">
                                <img src="{{ $department->image_url }}" alt="{{ $department->name }}">
                                <a wire:navigate href="{{ route('doctors', ['department' => $department->id]) }}"><i
                                        class="fas fa-link"></i></a>
                            </figure>
                            <div class="lower-content">

                                <h3><a wire:navigate href="{{ route('doctors', ['department' => $department->id]) }}">{{
                                        $department->name }}</a></h3>
                                <p class="p_relative d_block">{{ $department->description }}</p>
                                <div class="link p_relative d_block"><a wire:navigate
                                        href="{{ route('doctors', ['department' => $department->id]) }}">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        <h4>No departments found</h4>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- service-style-two end -->
</section>