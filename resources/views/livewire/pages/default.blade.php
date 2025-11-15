{{-- Default Page Template --}}
@include('livewire.includes.page-hero');

<div class="container py-5">
    <div class="row">
        <div class="col-lg-12">
            @if($page->featured_image_url)
            <img src="{{ $page->featured_image_url }}" alt="{{ $page->title }}" class="img-fluid rounded mb-4">
            @endif

            <div class="page-content">
                {!! $page->content !!}

                <!-- Show Doctors Linked To the Page -->
                @if($page->department()->exists())

                <!-- Doctors List -->
                <section class="team-page-section p_relative">
                    <div class="auto-container">
                        <div class="row clearfix">
                            @forelse($page->department->doctors as $doctor)

                            <div class="col-lg-4 col-md-4 col-sm-12 team-block">
                                <a wire:navigate href="{{ route('doctor-details', ['doctor' => $doctor->id]) }}">
                                    <div class="team-block-two wow fadeInUp animated animated" data-wow-delay="00ms"
                                        data-wow-duration="1500ms">
                                        <div class="inner-box">
                                            <figure class="image-box"><img src="{{ $doctor->image_url }}" alt="">
                                            </figure>
                                            <div class="lower-content p_relative d_block">
                                                <div class="share-box p_absolute">
                                                    <a wire:navigate href="{{ $doctor->facebook }}"
                                                        class="share-icon fs_14 d_iblock"><i class="icon-37"></i></a>
                                                    <ul class="share-links p_absolute clearfix">
                                                        <li><a href="mailto:{{ $doctor->email }}"><i
                                                                    class="fas fa-envelope"></i></a>
                                                        </li>
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

                @endif
            </div>
        </div>
    </div>
</div>
