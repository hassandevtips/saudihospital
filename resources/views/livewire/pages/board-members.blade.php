<section>
    @include('livewire.includes.page-hero');

    <!-- team-section -->
    <section class="team-page-section p_relative">
        <div class="auto-container">
            <div class="row clearfix">
                @forelse ($boardMembers as $member)
                <div class="col-lg-4 col-md-6 col-sm-12 team-block">
                    <div class="team-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box p_relative d_block pr_55">
                            <figure class="image-box p_relative d_block">
                                <img src="{{ $member->image_url ?? asset('assets/images/team/team-1.jpg') }}"
                                    alt="{{ $member->name }}">
                            </figure>
                            <div class="lower-content p_absolute r_0 b_45 b_shadow_6 z_1 tran_5">
                                <h3 class="d_block lh_30 mb_3 tran_5">
                                    <span class="d_iblock color_black">{{ $member->name }}</span>
                                </h3>
                                @if ($member->position)
                                <span class="designation p_relative d_block fs_16 lh_20 font_family_poppins tran_5">
                                    {{ $member->position }}
                                </span>
                                @endif
                                @php
                                $socialLinks = collect([
                                ['url' => $member->facebook_url, 'icon' => 'fab fa-facebook-f', 'label' => 'Facebook'],
                                ['url' => $member->twitter_url, 'icon' => 'fab fa-twitter', 'label' => 'X / Twitter'],
                                ['url' => $member->linkedin_url, 'icon' => 'fab fa-linkedin-in', 'label' => 'LinkedIn'],
                                ['url' => $member->pinterest_url, 'icon' => 'fab fa-pinterest-p', 'label' =>
                                'Pinterest'],
                                ])->filter(fn ($link) => filled($link['url']));
                                @endphp
                                @if ($socialLinks->isNotEmpty())
                                <ul class="social-links clearfix p_absolute l_25 b_14 tran_5">
                                    @foreach ($socialLinks as $link)
                                    <li class="p_relative d_iblock pull-left mr_25">
                                        <a href="{{ $link['url'] }}" class="d_iblock fs_15" target="_blank"
                                            rel="noopener" aria-label="{{ $link['label'] }}">
                                            <i class="{{ $link['icon'] }}"></i>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <p class="text-center">
                        {{ gt('board_member_info_soon', 'Board member information will be available soon.') }}
                    </p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- team-section end -->
</section>