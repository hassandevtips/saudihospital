<section>
    {{-- Contact Page Template --}}
    @include('livewire.includes.page-hero');





    <!-- contact-style-two -->
    <section class="contact-style-two p_relative mt-5">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url(assets/images/shape/shape-55.png);"></div>
            <div class="pattern-2" style="background-image: url(assets/images/shape/shape-56.png);"></div>
        </div>
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 big-column offset-lg-2">
                    <div class="form-inner">
                        <h2>{{ gt('leave_a_comment', 'Leave a Comment') }}</h2>
                        <livewire:contact-form />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-style-two end -->


</section>