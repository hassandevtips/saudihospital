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

                                        @if($news->video_url)
                                        <div class="video-section" style="margin-top: 30px;">
                                            <h4 style="margin-bottom: 15px;">{{ gt('video', 'Video') }}</h4>
                                            <video controls style="width: 100%; max-width: 100%; border-radius: 8px;">
                                                <source src="{{ $news->video_url }}" type="video/mp4">
                                                {{ gt('browser_no_video_support', 'Your browser does not support the video tag.') }}
                                            </video>
                                        </div>
                                        @endif

                                        @if($news->gallery_urls && count($news->gallery_urls) > 0)
                                        <div class="gallery-section" style="margin-top: 30px;">
                                            <h4 style="margin-bottom: 15px;">{{ gt('gallery', 'Gallery') }}</h4>
                                            <div class="row clearfix">
                                                @foreach($news->gallery_urls as $galleryImage)
                                                <div class="col-lg-3 col-md-4 col-sm-12" style="margin-bottom: 20px;">
                                                    <figure class="image-box" style="margin: 0;">
                                                        <img src="{{ $galleryImage }}" alt="Gallery Image"
                                                            style="width: 100%; height: 250px; object-fit: cover; border-radius: 8px; cursor: pointer;"
                                                            onclick="openGalleryModal('{{ $galleryImage }}')">
                                                    </figure>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif

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

    <!-- Gallery Modal -->
    <div id="galleryModal"
        style="display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.9);">
        <span onclick="closeGalleryModal()"
            style="position: absolute; top: 15px; right: 35px; color: #f1f1f1; font-size: 40px; font-weight: bold; cursor: pointer;">&times;</span>
        <img id="galleryModalImage"
            style="margin: auto; display: block; width: 80%; max-width: 1200px; margin-top: 50px;">
    </div>

    <script>
        function openGalleryModal(imageSrc) {
            document.getElementById('galleryModal').style.display = 'block';
            document.getElementById('galleryModalImage').src = imageSrc;
        }

        function closeGalleryModal() {
            document.getElementById('galleryModal').style.display = 'none';
        }

        // Close modal when clicking outside the image
        document.getElementById('galleryModal')?.addEventListener('click', function(event) {
            if (event.target.id === 'galleryModal') {
                closeGalleryModal();
            }
        });

        // Close modal with ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeGalleryModal();
            }
        });
    </script>
</section>
