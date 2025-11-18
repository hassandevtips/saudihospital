<?php
// Get Currnt Route name
$currentRouteName = Route::currentRouteName();
$isHomePage = $currentRouteName === 'home';
?>
<div>
    <!-- main header -->
    @php
    //@if($isHomePage??false) header-style-two @else header-style-one @endif
    @endphp
    <header class="main-header  ">
        <!-- header-top -->

        <div class="header-top">
            <div class="auto-container">
                <div class="top-inner">
                    <div class="left-column">
                        <ul class="info clearfix">
                            <li style="{{ app()->getLocale() === 'ar' ? 'margin-left: 20px;' : 'margin-right: 20px;' }}">{{ $settings['tagline'] }}</li>

                            <!-- Top Menu from menu table -->
                            @php
                            $topMenu = \App\Models\Menu::with('items.children')
                            ->where('key', 'top-menu')
                            ->first();
                            $menuItems = $topMenu ? $topMenu->getItemsArray() : [];
                            @endphp
                            @foreach($menuItems as $item)
                            <li>
                                @php
                                $title = $item['title'] ?? '';
                                if (is_array($title)) {
                                $locale = app()->getLocale();
                                $title = $title[$locale] ?? $title['en'] ?? ($title[array_key_first($title)] ?? '');
                                }
                                @endphp
                                <a href="{{ $item['url'] }}" target="{{ $item['blank'] ? '_blank' : '_self' }}">
                                    {{ $title }}
                                </a>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="right-column">
                        @if($toggleLanguage)
                        <div class="schedule" wire:click="switchToToggleLanguage"
                            style="cursor: pointer; display: inline-block; {{ app()->getLocale() === 'ar' ? 'margin-left: 15px;' : 'margin-right: 15px;' }}">
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
                        <figure class="logo"><a href="/" wire:navigate><img src="{{
                             asset($settings['logo']) }}" alt="{{ $settings['site_name'] }}"></a></figure>
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
                            <a wire:navigate href="{{ url('departments') }}" class="theme-btn btn-one">{{ gt('appointment', 'Appointment') }}</a>
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
                            <a href="#" class="theme-btn btn-one">{{ gt('appointment', 'Appointment') }}</a>
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
    
    <style>
        /* Header Layout Fixes */
        .header-lower {
            position: relative;
            padding: 20px 0;
        }
        
        .header-lower .outer-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }
        
        .header-lower .logo-box {
            flex-shrink: 0;
            z-index: 10;
        }
        
        .header-lower .logo-box figure {
            margin: 0;
        }
        
        .header-lower .logo-box figure img {
            max-height: 60px;
            width: auto;
        }
        
        .header-lower .menu-area {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        .header-lower .nav-right {
            flex-shrink: 0;
            z-index: 10;
        }
        
        /* Mobile Menu Visibility and Functionality */
        @media (max-width: 1199px) {
            .mobile-nav-toggler {
                display: block !important;
                cursor: pointer;
                position: relative;
                z-index: 1000;
                padding: 10px;
                background: transparent;
                border: none;
            }
            
            .mobile-nav-toggler .icon-bar {
                display: block;
                width: 30px;
                height: 3px;
                background: #02799c;
                margin: 6px 0;
                transition: all 0.3s ease;
                border-radius: 2px;
            }
            
            .mobile-nav-toggler:hover .icon-bar {
                background: #015f7a;
            }
            
            /* Ensure mobile menu is properly positioned */
            .mobile-menu {
                position: fixed;
                right: 0;
                top: 0;
                width: 300px;
                max-width: 85%;
                height: 100%;
                background: #fff;
                z-index: 99999;
                overflow-y: auto;
                transform: translateX(100%);
                transition: all 0.4s ease;
                box-shadow: -5px 0 15px rgba(0,0,0,0.1);
            }
            
            body.mobile-menu-visible .mobile-menu {
                transform: translateX(0);
            }
            
            .mobile-menu .menu-backdrop {
                position: fixed;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 99998;
                opacity: 0;
                visibility: hidden;
                transition: all 0.4s ease;
            }
            
            body.mobile-menu-visible .mobile-menu .menu-backdrop {
                opacity: 1;
                visibility: visible;
            }
            
            .mobile-menu .close-btn {
                position: absolute;
                right: 25px;
                top: 25px;
                font-size: 24px;
                color: #222;
                cursor: pointer;
                z-index: 10;
                width: 40px;
                height: 40px;
                line-height: 40px;
                text-align: center;
                border-radius: 50%;
                transition: all 0.3s ease;
            }
            
            .mobile-menu .close-btn:hover {
                background: #f5f5f5;
                transform: rotate(90deg);
            }
        }
        
        /* RTL Header Adjustments */
        body.rtl .header-lower .outer-box {
            flex-direction: row-reverse;
        }
        
        body.rtl .header-top .left-column {
            text-align: right;
        }
        
        body.rtl .header-top .right-column {
            text-align: left;
        }
        
        /* RTL Mobile Menu */
        @media (max-width: 1199px) {
            body.rtl .mobile-menu {
                right: auto !important;
                left: 0 !important;
                transform: translateX(-100%) !important;
            }
            
            body.rtl.mobile-menu-visible .mobile-menu {
                transform: translateX(0) !important;
            }
            
            body.rtl .mobile-menu .close-btn {
                right: auto;
                left: 25px;
            }
            
            body.rtl .mobile-menu .menu-box {
                text-align: right;
                padding: 30px;
            }
            
            body.rtl .mobile-menu .navigation li {
                text-align: right;
            }
            
            body.rtl .mobile-menu .navigation li a {
                text-align: right;
                justify-content: flex-end;
            }
            
            body.rtl .mobile-menu .dropdown-btn {
                left: 0;
                right: auto;
            }
        }
        
        @media (max-width: 991px) {
            body.rtl .header-top .left-column,
            body.rtl .header-top .right-column {
                text-align: center;
            }
            
            .header-lower .outer-box {
                padding: 0 15px;
            }
        }
        
        /* Mobile Responsive Header */
        @media (max-width: 767px) {
            .header-lower {
                padding: 15px 0;
            }
            
            .header-lower .logo-box figure img {
                max-height: 50px;
            }
            
            .header-lower .nav-right .btn-box {
                display: none;
            }
            
            .header-top .info {
                display: none;
            }
            
            .header-lower .outer-box {
                gap: 10px;
            }
            
            .mobile-nav-toggler {
                order: 3;
            }
            
            .header-lower .logo-box {
                order: 2;
            }
            
            .header-lower .nav-right {
                order: 1;
            }
            
            body.rtl .mobile-nav-toggler {
                order: 1;
            }
            
            body.rtl .header-lower .logo-box {
                order: 2;
            }
            
            body.rtl .header-lower .nav-right {
                order: 3;
            }
        }
        
        @media (max-width: 575px) {
            .header-lower .logo-box figure img {
                max-height: 45px;
            }
            
            .mobile-nav-toggler .icon-bar {
                width: 25px;
            }
        }
    </style>
</div>
