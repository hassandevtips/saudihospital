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

    <title>{{ $title ?? 'Saudi Hospital' }}</title>

    <!-- Fav Icon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">

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
    @if($isRTL)
    <!-- Arabic Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap"
        rel="stylesheet">
    @endif

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
    @if($isRTL)
    <!-- RTL Stylesheet -->
    <link href="{{ asset('assets/css/rtl.css') }}" rel="stylesheet">
    <style>
        /* Apply Arabic fonts for RTL layout */
        body.rtl {
            font-family: 'Cairo', 'Tajawal', 'Rubik', sans-serif;
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
        body.rtl .text-center,
        body.rtl .card,
        body.rtl .card-body,
        body.rtl .container,
        body.rtl .row {
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
    </style>
    @endif

    @livewireStyles
    @stack('styles')
</head>

<body @class(['lang-'.$locale, 'rtl'=> $isRTL, 'ltr' => !$isRTL])>
    <div class="boxed_wrapper">
        <!-- preloader -->
        <div id="preloader" style="display: none;">
            <div class="loader-content">
                <img src="{{ asset('assets/images/footer-logo.png') }}" alt="Hospital Logo" class="loader-logo">
                <h2 class="loader-text" style="color: #fff;">Loading <span class="dots"></span></h2>
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
            <a href="#" class="floating-btn">Floating Book Appointment 24/7</a>
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
        });
    </script>

    @livewireScripts
    @stack('scripts')
</body>

</html>
