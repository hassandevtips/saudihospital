<!DOCTYPE html>
<html lang="en">

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

    @stack('styles')
</head>

<body>
    <div class="boxed_wrapper">
        <!-- preloader -->
        <div id="preloader">
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
        });
    </script>

    @stack('scripts')
</body>

</html>