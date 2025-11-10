<div>
    <!-- main header -->
    <header class="main-header header-style-two">
        <!-- header-top -->

        <div class="header-top">
            <div class="auto-container">
                <div class="top-inner">
                    <div class="left-column">
                        <ul class="info clearfix">
                            <li>{{ $settings['tagline'] }}</li>


                        </ul>
                    </div>
                    <div class="right-column">
                        @if($toggleLanguage)
                        <div class="schedule" wire:click="switchToToggleLanguage"
                            style="cursor: pointer; display: inline-block; margin-right: 15px;">
                            {{ $toggleLanguage->native_name }}
                        </div>
                        @endif
                        <ul class="social-links clearfix">
                            <li><a href="{{ $settings['facebook'] }}"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="{{ $settings['twitter'] }}"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="{{ $settings['linkedin'] }}"><i class="fab fa-linkedin-in"></i></a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- header-lower -->
        <div class="header-lower" style="border-bottom: 1px solid #ffffff24;">
            <div class="auto-container">
                <div class="outer-box">
                    <div class="logo-box">
                        <figure class="logo"><a href="/" wire:navigate><img src="{{ asset($settings['logo']) }}"
                                    alt="{{ $settings['site_name'] }}"></a></figure>
                    </div>
                    <div class="menu-area clearfix">
                        <!--Mobile Navigation Toggler-->
                        <div class="mobile-nav-toggler">
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                        </div>
                        <nav class="main-menu navbar-expand-md navbar-light">
                            <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                <x-navigation-menu :menu="$menu" />
                            </div>
                        </nav>
                    </div>
                    <div class="nav-right">

                        <div class="btn-box">
                            <a href="#" class="theme-btn btn-one">Appointment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--sticky Header-->
        <div class="sticky-header">
            <div class="auto-container">
                <div class="outer-box">
                    <div class="logo-box">
                        <figure class="logo"><a href="/" wire:navigate><img src="{{ asset($settings['logo']) }}"
                                    alt="{{ $settings['site_name'] }}"></a></figure>
                    </div>
                    <div class="menu-area clearfix">
                        <nav class="main-menu clearfix">
                            <!--Keep This Empty / Menu will come through Javascript-->
                        </nav>
                    </div>
                    <div class="nav-right">
                        <div class="search-box-outer search-toggler">
                            <i class="icon-5"></i>
                        </div>
                        <div class="btn-box">
                            <a href="#" class="theme-btn btn-one">Appointment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- main-header end -->

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><i class="fas fa-times"></i></div>

        <nav class="menu-box">
            <div class="nav-logo"><a href="/" wire:navigate><img src="{{ asset($settings['logo']) }}"
                        alt="{{ $settings['site_name'] }}" title="{{ $settings['site_name'] }}"></a></div>
            <div class="menu-outer">
                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
            </div>
            <div class="contact-info">
                <h4>Contact Info</h4>
                <ul>
                    <li>{{ $settings['address'] }}</li>
                    <li><a href="tel:{{ $settings['phone'] }}">{{ $settings['phone'] }}</a></li>
                    <li><a href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a></li>
                </ul>
            </div>
            <div class="social-links">
                <ul class="clearfix">
                    <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                    <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                    <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                    <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                    <li><a href="#"><span class="fab fa-youtube"></span></a></li>
                </ul>
            </div>
        </nav>
    </div><!-- End Mobile Menu -->
</div>
