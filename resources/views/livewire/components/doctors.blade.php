<div>
    <section class="team-section p_relative">

        <div class="auto-container">
            <div class="sec-title p_relative left mb_50">

                <h2>{{ gt('senior_doctors') }}</h2>
                <a href="{{ route('department-doctors') }}" class="theme-btn btn-two">{{ gt('view_all_doctors') }}</a>
            </div>
            <div class="row clearfix">
                @forelse($doctors as $index => $doctor)
                <div class="col-lg-4 col-md-6 col-sm-12 team-block">
                    <div class="team-block-one wow fadeInUp animated animated" data-wow-delay="{{ $index * 300 }}ms"
                        data-wow-duration="1500ms">
                        <div class="inner-box p_relative d_block pr_55">
                            <figure class="image-box p_relative d_block"><img src="{{ $doctor->image_url }}"
                                    alt="{{ $doctor->name }}"></figure>
                            <div class="lower-content p_absolute r_0 b_45 b_shadow_6 z_1 tran_5">
                                <h3 class="d_block lh_30 mb_3 tran_5"><a href="#" class="d_iblock color_black">{{
                                        $doctor->name }}</a></h3>
                                <span class="designation p_relative d_block fs_16 lh_20 font_family_poppins tran_5">{{
                                    $doctor->specialization }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-lg-4 col-md-6 col-sm-12 team-block">
                    <div class="team-block-one wow fadeInUp animated animated" data-wow-delay="00ms"
                        data-wow-duration="1500ms">
                        <div class="inner-box p_relative d_block pr_55">
                            <figure class="image-box p_relative d_block"><img src="assets/images/team/team-1.jpg"
                                    alt=""></figure>
                            <div class="lower-content p_absolute r_0 b_45 b_shadow_6 z_1 tran_5">
                                <h3 class="d_block lh_30 mb_3 tran_5"><a href="#" class="d_iblock color_black">Dr. Nada
                                        Nabil Bader</a></h3>
                                <span
                                    class="designation p_relative d_block fs_16 lh_20 font_family_poppins tran_5">Nephrology
                                    and Internal Diseases</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
