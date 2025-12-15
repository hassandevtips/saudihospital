@php
$news = \App\Models\News::active()->paginate(10);
@endphp
<section>
    @include('livewire.includes.page-hero');


    <!-- research-section -->
    <section class="news-section blog-grid p_relative">
        <div class="auto-container">
            <div class="row clearfix">
                @forelse($news as $item)
                <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                    <div class="news-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <figure class="image-box">
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}">
                                <a wire:navigate href="{{ route('news-details', ['id' => $item->id]) }}"><i
                                        class="fas fa-link"></i></a>
                            </figure>
                            <div class="lower-content">
                                <div class="inner">
                                    <div class="category"><a wire:navigate
                                            href="{{ route('news-details', ['id' => $item->id]) }}">{{ gt('research', 'Research') }}</a></div>
                                    <h3><a wire:navigate href="{{ route('news-details', ['id' => $item->id]) }}">{{
                                            $item->title }}</a></h3>
                                    <ul class="post-info clearfix">
                                        <li><i class="icon-34"></i>{{ $item->published_date->format('d M, Y') }}</li>
                                        <li><i class="icon-35"></i><a href="#">{{ $item->author }}</a>
                                        </li>
                                    </ul>
                                    <p>{{ Str::limit(strip_tags($item->content), 100) }}</p>
                                    <div class="link"><a wire:navigate
                                            href="{{ route('news-details', ['id' => $item->id]) }}">{{ gt('read-more', 'Read More')
                                            }}</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-lg-12 col-md-12 col-sm-12 news-block">
                    <div class="news-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="text">
                                <h2>{{ gt('no_research_found', 'No research articles found') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
            <div class="pagination-wrapper centred">
                {{ $news->onEachSide(1)->links('vendor.pagination.news') }}
            </div>
        </div>
    </section>
    <!-- research-section end -->
</section>

