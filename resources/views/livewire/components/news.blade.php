<div>
    <!-- skills-section end -->


    <!-- project-section -->

    <!-- project-section end -->


    <!-- news-section -->
    <section class="news-section p_relative" style="background-color: #f7f8ff; margin-top: 90px;">
        <div class="auto-container">
            <div class="sec-title centred mb_50">

                <h2>Latest News & Blogs
                </h2>
            </div>
            <div class="row clearfix">
                @forelse($news as $index => $item)
                <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                    <div class="news-block-one wow fadeInUp animated" data-wow-delay="{{ $index * 300 }}ms"
                        data-wow-duration="1500ms">
                        <div class="inner-box">
                            <figure class="image-box">
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}">
                                <a wire:navigate href="{{ route('news-details', ['id' => $item->id]) }}"><i
                                        class="fas fa-link"></i></a>
                            </figure>
                            <div class="lower-content">
                                <div class="inner">
                                    <h3><a wire:navigate href="{{ route('news-details', ['id' => $item->id]) }}">{{
                                            $item->title }}</a></h3>
                                    <ul class="post-info clearfix">
                                        <li><i class="icon-34"></i>{{ $item->published_date->format('d M, Y') }}
                                        </li>
                                        <li><i class="icon-35"></i><a href="#">{{ $item->author }}</a></li>
                                    </ul>
                                    <p>{{ Str::limit($item->content, 100) }}</p>
                                    <div class="link"><a wire:navigate
                                            href="{{ route('news-details', ['id' => $item->id]) }}">Read more</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                    <div class="news-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <figure class="image-box">
                                <img src="assets/images/news/news-1.jpg" alt="">
                                <a href="#"><i class="fas fa-link"></i></a>
                            </figure>
                            <div class="lower-content">
                                <div class="inner">
                                    <h3><a href="#">Pulmonology Clinic</a></h3>
                                    <ul class="post-info clearfix">
                                        <li><i class="icon-34"></i>10 Oct, 2025</li>
                                        <li><i class="icon-35"></i><a href="#">admin</a></li>
                                    </ul>
                                    <p>We believe every patient has the right to be treated with dignity.</p>
                                    <div class="link"><a href="#">Read more</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>
</div>