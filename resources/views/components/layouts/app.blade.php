@php
$locale = app()->getLocale();
$isRTL = $locale === 'ar';
$dir = $isRTL ? 'rtl' : 'ltr';
@endphp

<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $dir }}" @class(['rtl'=> $isRTL, 'ltr' => !$isRTL])>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    @php
    $siteName = \App\Models\SiteSetting::get('site_name', 'Saudi Hospital');
    $page = \App\Models\Page::where('slug', request()->path())->first();
    @endphp

    <title>{{ $page->title ?? $siteName }}</title>

    <!-- Fav Icon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">


    <!-- Arabic Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">


    <!-- Stylesheets -->
    <link href="{{ asset('assets/css/font-awesome-all.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/owl.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/jquery.fancybox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/color.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/elpath.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/nice-select.css') }}" rel="stylesheet">
    @if($isRTL)
    <!-- RTL Stylesheet -->
    <link href="{{ asset('assets/css/rtl.css') }}" rel="stylesheet">
    <style>
        /* Apply Arabic fonts for RTL layout */
        body.rtl {
            font-family: 'Almarai', sans-serif;
            direction: rtl;
            text-align: right;
        }

        /* RTL alignment for common elements */
        body.rtl .bread-crumb,
        body.rtl .bread-crumb li,
        body.rtl .bread-crumb ul,
        body.rtl .auto-container,
        body.rtl .content-box,
        body.rtl .page-title,
        body.rtl h1,
        body.rtl h2,
        body.rtl h3,
        body.rtl h4,
        body.rtl h5,
        body.rtl h6,
        body.rtl p,
        body.rtl a,
        body.rtl strong,
        body.rtl em,
        body.rtl b,
        body.rtl u,
        body.rtl s,
        body.rtl small,
        body.rtl sub,
        body.rtl sup,
        body.rtl label,
        body.rtl input,
        body.rtl textarea,
        body.rtl select,
        body.rtl button,
        body.rtl ul,
        body.rtl ol,
        body.rtl li,
        body.rtl dl,
        body.rtl dt,
        body.rtl dd,
        body.rtl table,
        body.rtl thead,
        body.rtl tbody,
        body.rtl tfoot,
        body.rtl form,
        body.rtl .sub-title,
        body.rtl .text-center,
        body.rtl .card,
        body.rtl .card-body,
        body.rtl .container,
        body.rtl .row {
            font-family: 'Almarai', sans-serif !important;
            direction: rtl;
            text-align: right;
        }

        /* Override text-center for RTL when needed */
        body.rtl .text-center {
            text-align: center !important;
        }

        /* Fix breadcrumb alignment for RTL - override theme styles */
        body.rtl .page-title .content-box .bread-crumb {
            direction: rtl;
            text-align: right;
        }

        body.rtl .page-title .content-box .bread-crumb li {
            float: right !important;
            padding-right: 0 !important;
            padding-left: 20px !important;
            margin-right: 0 !important;
            margin-left: 13px !important;
        }

        body.rtl .page-title .content-box .bread-crumb li:last-child {
            padding-left: 0 !important;
            margin-left: 0 !important;
        }

        /* Reverse breadcrumb separator for RTL */
        body.rtl .page-title .content-box .bread-crumb li:before {
            content: "\f104" !important;
            font-family: 'Font Awesome 5 Pro', 'Font Awesome 5 Free' !important;
            right: auto !important;
            left: 0px !important;
        }

        body.rtl .page-title .content-box .bread-crumb li:last-child:before {
            display: none !important;
        }

        /* Ensure proper RTL for lists */
        body.rtl ul,
        body.rtl ol {
            padding-right: 20px;
            padding-left: 0;
        }

        /* RTL fixes for Bootstrap elements */
        body.rtl .row {
            direction: rtl;
        }

        body.rtl [class*="col-"] {
            direction: rtl;
        }

        /* RTL alignment for cards and containers */
        body.rtl .card-body,
        body.rtl .content-box,
        body.rtl .page-content {
            text-align: right;
        }

        /* Fix float directions for RTL */
        body.rtl .clearfix::after {
            clear: both;
        }

        body.rtl .text-left {
            text-align: right !important;
        }

        body.rtl .text-right {
            text-align: left !important;
        }

        /* RTL Header Fixes */
        body.rtl .header-top .left-column {
            text-align: right;
        }

        body.rtl .header-top .right-column {
            text-align: left;
        }

        body.rtl .header-top .info li {
            float: right;
            margin-right: 0;
            margin-left: 20px;
        }

        body.rtl .header-top .social-links li {
            float: right;
            margin-right: 0;
            margin-left: 10px;
        }

        body.rtl .header-lower .outer-box {
            display: flex;
            flex-direction: row-reverse;
            align-items: center;
        }

        body.rtl .logo-box {
            margin-right: 0;
            margin-left: auto;
        }

        body.rtl .menu-area {
            margin-right: auto;
            margin-left: 0;
        }

        body.rtl .nav-right {
            margin-left: 0;
            margin-right: auto;
        }

        /* RTL Mobile Menu */
        body.rtl .mobile-menu {
            right: auto !important;
            left: 0 !important;
        }

        body.rtl .mobile-menu .close-btn {
            right: auto;
            left: 30px;
        }

        body.rtl .mobile-menu .menu-box {
            text-align: right;
        }

        body.rtl .mobile-menu .navigation li {
            text-align: right;
        }

        body.rtl .mobile-nav-toggler {
            margin-left: 0;
            margin-right: 15px;
        }
    </style>
    @endif

    <!-- Additional Responsive Enhancements -->
    <style>
        /* Mobile Menu Enhancements */
        @media (max-width: 991px) {
            .mobile-menu {
                position: fixed;
                right: 0;
                top: 0;
                width: 300px;
                max-width: 80%;
                height: 100%;
                background: #fff;
                z-index: 999999;
                overflow-y: auto;
                transform: translateX(100%);
                transition: all 0.3s ease;
            }

            .mobile-menu.mobile-menu-visible {
                transform: translateX(0);
            }

            .mobile-menu .menu-backdrop {
                position: fixed;
                right: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.7);
                z-index: -1;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
            }

            .mobile-menu-visible .menu-backdrop {
                opacity: 1;
                visibility: visible;
            }
        }

        /* Ensure Bootstrap Grid Works Properly */
        @media (max-width: 575px) {

            .col-lg-3,
            .col-lg-4,
            .col-lg-6,
            .col-lg-8,
            .col-lg-12,
            .col-md-3,
            .col-md-4,
            .col-md-6,
            .col-md-8,
            .col-md-12 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        @media (min-width: 576px) and (max-width: 767px) {
            .col-sm-12 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            .col-md-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }

            .col-md-12 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        /* Touch-Friendly Buttons */
        @media (max-width: 767px) {

            .theme-btn,
            button,
            a.btn,
            input[type="submit"],
            input[type="button"] {
                min-height: 44px;
                min-width: 44px;
                padding: 12px 20px;
            }
        }

        /* Prevent Horizontal Scroll */
        body {
            overflow-x: hidden;
        }

        .row {
            margin-left: -15px;
            margin-right: -15px;
        }

        /* Responsive Images */
        img {
            max-width: 100%;
            height: auto;
        }

        /* Responsive Tables */
        @media (max-width: 767px) {
            table {
                display: block;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
        }

        /* Owl Carousel Responsive */
        @media (max-width: 767px) {
            .owl-carousel .owl-item img {
                width: auto;
                max-width: 100%;
            }
        }

        /* Fix for iOS Safari */
        @supports (-webkit-touch-callout: none) {
            body {
                -webkit-text-size-adjust: 100%;
            }
        }

        /* Smooth Scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Viewport Height Fix for Mobile Browsers */
        @media (max-width: 767px) {

            .banner-style-two .slide-item,
            .page-title {
                min-height: 100vh;
                min-height: -webkit-fill-available;
            }
        }

        /* Hamburger Menu Icon */
        .mobile-nav-toggler {
            display: none;
            cursor: pointer;
            padding: 10px;
        }

        @media (max-width: 1199px) {
            .mobile-nav-toggler {
                display: block;
            }
        }

        /* RTL Mobile Adjustments */
        @media (max-width: 1199px) {
            body.rtl .mobile-menu {
                right: auto !important;
                left: 0 !important;
                transform: translateX(-100%) !important;
            }

            body.rtl .mobile-menu-visible .mobile-menu {
                transform: translateX(0) !important;
            }

            body.rtl .mobile-menu .close-btn {
                right: auto;
                left: 25px;
            }

            body.rtl .mobile-menu .menu-box {
                padding-right: 30px;
                padding-left: 30px;
            }

            body.rtl .mobile-menu .navigation li {
                text-align: right;
            }

            body.rtl .mobile-menu .navigation li a {
                text-align: right;
            }

            body.rtl .mobile-menu .dropdown-btn {
                left: 0;
                right: auto;
            }
        }
    </style>

    @livewireStyles
    @stack('styles')
</head>

<body @class(['lang-'.$locale, 'rtl'=> $isRTL, 'ltr' => !$isRTL])>
    <div class="boxed_wrapper">
        <!-- preloader -->
        <div id="preloader" style="display: none;">
            <div class="loader-content loader-text">
                <h1>الهوية الجديدة للرعاية الصحية</h1>
                <h3>{{ gt('home_heading', 'The New Definition of Healthcare') }}</h3>
                <div class="progress-bar">
                    <div class="progress-fill" id="progress"></div>
                </div>
                <div class="percent-text" id="percent">0%</div>
            </div>
        </div>
        <!-- preloader end -->

        <div id="main-content">
            {{-- Header Component --}}
            @livewire('header')
            {{ $slot }}
            {{-- Footer Component --}}
            @livewire('footer')

            {{-- Scroll to Top Button --}}
            <button class="scroll-top scroll-to-target" data-target="html">
                <i class="fal fa-long-arrow-up"></i>
            </button>

            {{-- Floating Appointment Button --}}
            <a href="#" class="floating-btn">Book Appointment 24/7</a>
        </div>
    </div>

    <!-- jequery plugins -->
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.js') }}"></script>
    <script src="{{ asset('assets/js/wow.js') }}"></script>
    <script src="{{ asset('assets/js/validation.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('assets/js/appear.js') }}"></script>
    <script src="{{ asset('assets/js/scrollbar.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/js/text_animation.js') }}"></script>
    <script src="{{ asset('assets/js/text_plugins.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.countTo.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>

    <script>
        $(document).ready(function () {
            // Check if preloader has been shown in this session
            // With wire:navigate, the layout persists so this only runs on full page loads
            const preloaderShown = sessionStorage.getItem('preloaderShown');

            if (!preloaderShown) {
                // Mark that preloader has been shown for this session
                sessionStorage.setItem('preloaderShown', 'true');

                // Show preloader only on first page load in session
                $("#preloader").show();
                $("#main-content").hide();

                let value = 0;
                let interval = setInterval(function () {
                    value += Math.floor(Math.random() * 8) + 5;
                    if (value > 100) value = 100;

                    $("#progress").css("width", value + "%");
                    $("#percent").text(value + "%");

                    if (value === 100) {
                        clearInterval(interval);
                        setTimeout(function () {
                            $("#preloader").fadeOut(700, function () {
                                $("#main-content").fadeIn(500);
                            });
                        }, 400);
                    }
                }, 300);
            } else {
                // Preloader already shown in this session, hide it immediately
                $("#preloader").hide();
                $("#main-content").show();
            }

            // Ensure preloader stays hidden during Livewire navigation
            // (This is a safety measure, as wire:navigate won't reload the layout)
            document.addEventListener('livewire:navigating', function () {
                $("#preloader").hide();
                $("#main-content").show();
            });

            // Function to initialize nice-select
            function initNiceSelect() {
                // Destroy existing nice-select instances first
                if ($('.nice-select').length) {
                    $('select:not(.ignore)').each(function() {
                        var $select = $(this);
                        var $niceSelect = $select.next('.nice-select');
                        if ($niceSelect.length) {
                            $niceSelect.remove();
                            $select.show();
                        }
                    });
                }
                // Reinitialize nice-select
                $('select:not(.ignore)').niceSelect();
            }

            // Initialize on page load
            initNiceSelect();

            // Reinitialize after Livewire navigation
            document.addEventListener('livewire:navigated', function () {
                setTimeout(function() {
                    initNiceSelect();
                }, 100);
            });
        });
    </script>

    @livewireScripts
    @stack('scripts')
</body>

</html>
