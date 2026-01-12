<section>
    @include('livewire.includes.page-hero' ,['banner_image_url' => $research->banner_image_url]);
    <!-- sidebar-page-container -->
    <section class="sidebar-page-container p_relative">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 content-side">
                    <div class="blog-details-content">
                        <div class="news-block-one">
                            <div class="inner-box">
                                <figure class="image-box" style="max-width: 1200px; margin: 0 auto;">
                                    <img src="{{ $research->image_url }}" alt="{{ $research->title }}" style="width: 100%; height: auto; object-fit: cover; border-radius: 8px;">
                                </figure>
                                <div class="lower-content">
                                    <div class="inner">
                                        <div class="category"><a href="#">{{ gt('research', 'Research') }}</a></div>
                                        <h3>{{ $research->title }}</h3>
                                        <ul class="post-info clearfix">
                                            <li><i class="icon-34"></i>{{ $research->published_date->format('d M, Y') }}
                                            </li>
                                            <li><i class="icon-35"></i><a href="#">{{ $research->author }}</a>
                                            </li>
                                        </ul>
                                        <div class="news-content">
                                            {!! $research->content !!}
                                        </div>

                                        @if($research->video_url)
                                        <div class="video-section" style="margin-top: 30px;">
                                            <h4 style="margin-bottom: 15px;">{{ gt('video', 'Video') }}</h4>
                                            <div style="max-width: 900px; margin: 0 auto;">
                                                <video controls style="width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                                                    <source src="{{ $research->video_url }}" type="video/mp4">
                                                    {{ gt('browser_no_video_support', 'Your browser does not support the video tag.') }}
                                                </video>
                                            </div>
                                        </div>
                                        @endif

                                        @if($research->gallery_urls && count($research->gallery_urls) > 0)
                                        <div class="gallery-section" style="margin-top: 30px;">
                                            <h4 style="margin-bottom: 15px;">{{ gt('gallery', 'Gallery') }}</h4>
                                            <div class="row clearfix" style="max-width: 1200px; margin: 0 auto;">
                                                @foreach($research->gallery_urls as $galleryImage)
                                                <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 25px;">
                                                    <figure class="image-box" style="margin: 0; overflow: hidden; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                                                        <img src="{{ $galleryImage }}" alt="Gallery Image"
                                                            style="width: 100%; height: 300px; object-fit: cover; cursor: pointer; transition: transform 0.3s ease;"
                                                            onclick="openGalleryModal('{{ $galleryImage }}')"
                                                            onmouseover="this.style.transform='scale(1.05)'"
                                                            onmouseout="this.style.transform='scale(1)'">
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

    <style>
        /* Desktop optimizations for research page */
        @media (min-width: 992px) {
            .news-block-one .image-box {
                max-height: 600px;
                overflow: hidden;
            }

            .video-section video {
                max-height: 600px;
            }

            .gallery-section .image-box {
                height: 300px;
            }
        }

        /* Tablet optimizations */
        @media (min-width: 768px) and (max-width: 991px) {
            .gallery-section .image-box {
                height: 250px;
            }
        }

        /* Mobile optimizations */
        @media (max-width: 767px) {
            .video-section > div {
                max-width: 100% !important;
            }

            .gallery-section .row {
                max-width: 100% !important;
            }

            .gallery-section .image-box {
                height: 200px;
            }

            .news-block-one .image-box img {
                border-radius: 4px;
            }
        }
    </style>
</section>

