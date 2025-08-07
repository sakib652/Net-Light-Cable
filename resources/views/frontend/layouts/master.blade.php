@php $setting = \App\Helpers\SettingsHelper::getSetting(); @endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Net Light Cable Industries</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    @if ($setting->favicon_image)
        <link rel="shortcut icon" href="{{ asset('uploads/logo_and_icon/' . $setting->favicon_image) }}"
            type="image/x-icon" />
    @else
        <link rel="shortcut icon" href="{{ asset('uploads/no_images/no-image.png') }}" type="image/x-icon" />
    @endif

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inter:slnt,wght@-10..0,100..900&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/lib/animate/animate.min.css" />
    <link href="{{ asset('frontend/assets') }}/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="{{ asset('frontend/assets') }}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('frontend/assets') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('frontend/assets') }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('frontend/assets') }}/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/glightbox.css">
    <link rel="stylesheet" href="{{ asset('frontend/assets') }}/css/glightbox.min.css">

    @stack('styles')
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    @include('frontend.partials.header')

    @yield('content')

    @include('frontend.partials.footer')


    <!-- Back to Top -->
    <a href="#" class="btn btn-success btn-lg-square rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/assets') }}/lib/wow/wow.min.js"></script>
    <script src="{{ asset('frontend/assets') }}/lib/easing/easing.min.js"></script>
    <script src="{{ asset('frontend/assets') }}/lib/waypoints/waypoints.min.js"></script>
    <script src="{{ asset('frontend/assets') }}/lib/counterup/counterup.min.js"></script>
    <script src="{{ asset('frontend/assets') }}/lib/lightbox/js/lightbox.min.js"></script>
    <script src="{{ asset('frontend/assets') }}/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/glightbox.js"></script>
    <script src="{{ asset('frontend/assets') }}/js/glightbox.min.js"></script>
    <script src="{{ asset('frontend/assets') }}/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.category-carousel').owlCarousel({
                loop: true,
                margin: 20,
                autoplay: true,
                autoplayTimeout: 3000,
                responsive: {
                    0: {
                        items: 1
                    },
                    576: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    992: {
                        items: 4
                    }
                }
            });
        });
    </script>

    <script>
        const lightbox = GLightbox({
            selector: '.glightbox'
        });
    </script>


    <!-- Template Javascript -->
    <script src="{{ asset('frontend/assets') }}/js/main.js"></script>

    @stack('scripts')
</body>

</html>
