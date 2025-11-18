<section>
    {{-- Default Page Template --}}
    @include('livewire.includes.page-hero');


    <!-- service-details -->
    <section class="service-details p_relative">
        <div class="auto-container">
            <div class="row clearfix">
                {{-- <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="service-sidebar mr_40">
                        <div class="text">
                            <h3>Categories</h3>
                        </div>
                        <ul class="category-list clearfix">
                            <li><a wire:navigate href="{{ route('department-doctors') }}">All Treatment</a></li>
                            @forelse($departments as $department)
                            <li><a wire:navigate href="{{ route('doctors', ['department' => $department->id]) }}">{{
                                    $department->name
                                    }}</a></li>
                            @empty
                            <li><a href="#" style="color: #666;">No departments available</a></li>
                            @endforelse
                        </ul>
                    </div>
                </div> --}}
                <div class="col-lg-12 col-md-12 col-sm-12 content-side">
                    <div class="service-details-content">
                        <div class="content-one mb-0">
                            <div class="text mb-0">

                                <h2>{{ $currentDepartment->name }} Doctors</h2>
                                {!! $currentDepartment->description !!}
                            </div>
                        </div>

                        <!-- Doctors List -->
                        <section class="team-page-section p_relative" style="padding-top: 30px !important;">
                            <div class="auto-container">
                                <div class="row clearfix">
                                    @forelse($doctors as $doctor)

                                    <div class="col-lg-3 col-md-3 col-sm-12 team-block">
                                        <a wire:navigate
                                            href="{{ route('doctor-details', ['doctor' => $doctor->id]) }}">
                                            <div class="team-block-two wow fadeInUp animated animated"
                                                data-wow-delay="00ms" data-wow-duration="1500ms">
                                                <div class="inner-box">
                                                    <figure class="image-box"><img src="{{ $doctor->image_url }}"
                                                            alt="">
                                                    </figure>
                                                    <div class="lower-content p_relative d_block">
                                                        <div class="share-box p_absolute">
                                                            <a wire:navigate href="{{ $doctor->facebook }}"
                                                                class="share-icon fs_14 d_iblock"><i
                                                                    class="icon-37"></i></a>
                                                            <ul class="share-links p_absolute clearfix">
                                                                <li><a href="mailto:{{ $doctor->email }}"><i
                                                                            class="fas fa-envelope"></i></a></li>
                                                                <li><a href="tel:{{ $doctor->phone }}"><i
                                                                            class="fas fa-phone"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <h3>{{
                                                            $doctor->name }}</h3>
                                                        <span class="designation">{{ $doctor->specialization }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    @empty
                                    <div class="col-12">
                                        <div class="alert alert-info">
                                            <h4>No doctors found</h4>
                                        </div>
                                    </div>
                                    @endforelse

                                </div>
                            </div>
                        </section>
                        <!-- team-section end -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- service-details end -->

</section>
