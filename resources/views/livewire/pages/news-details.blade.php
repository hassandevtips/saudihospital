<section>
    @include('livewire.includes.page-hero' ,['banner_image_url' => $news->banner_image_url]);
    <!-- sidebar-page-container -->
    <section class="sidebar-page-container p_relative">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 content-side">
                    <div class="blog-details-content">
                        <div class="news-block-one">
                            <div class="inner-box">
                                <figure class="image-box">
                                    <img src="{{ $news->image_url }}" alt="{{ $news->title }}">
                                </figure>
                                <div class="lower-content">
                                    <div class="inner">
                                        <div class="category"><a href="#">{{ $news->category }}</a></div>
                                        <h3>{{ $news->title }}</h3>
                                        <ul class="post-info clearfix">
                                            <li><i class="icon-34"></i>{{ $news->published_date->format('d M, Y') }}
                                            </li>
                                            <li><i class="icon-35"></i><a href="#">{{ $news->author }}</a>
                                            </li>
                                        </ul>
                                        <p>{{ $news->content }}</p>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- sidebar-page-container end -->
</section>