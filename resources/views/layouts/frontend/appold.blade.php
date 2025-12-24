<!doctype html>
<html lang="zxx">

<head>

    <!--========= Required meta tags =========-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ env('APP_NAME') }} | {{ $pageTitle ?? '' }}</title>

    <link rel="shortcut icon" href="{{asset('frontend/assets/img/favicon.png')}}" type="images/x-icon"/>
    <!-- css include -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/swiper.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/odometer.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/main.css')}}">

    @stack('frontend-css')
</head>

<body>

<!-- backtotop - start -->
<div class="xb-backtotop">
    <a href="#" class="scroll">
        <i class="far fa-arrow-up"></i>
    </a>
</div>
<!-- backtotop - end -->

<!-- preloader start -->
<div id="xb-loadding">
    <div class="loader">
        <div class="plane">
            <img class="plane-img" src="{{asset('frontend/assets/img/icon/plane.gif')}}" alt="">
        </div>
        <div class="earth-wrapper">
            <div class="earth"></div>
        </div>
    </div>
</div>
<!-- preloader end -->

<div class="body_wrap">

    <!-- header start -->
    @include('layouts.frontend.navbar')
    <!-- header end -->

    <!-- header search start -->
    <div class="header-search-form-wrapper">
        <div class="xb-search-close xb-close"></div>
        <div class="header-search-container">
            <form role="search" class="search-form" action="#">
                <input type="search" class="search-field" placeholder="Search …" value="" name="s">
            </form>
        </div>
    </div>

    <div class="body-overlay"></div>
    <main>
        @yield('content')
    </main>
    <!-- footer start -->
    @include('layouts.frontend.footer')
    <!-- footer start -->

</div>

<!-- jquery include -->
<script src="{{asset('frontend/assets/js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/swiper.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/wow.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/appear.js')}}"></script>
<script src="{{asset('frontend/assets/js/odometer.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/parallax-scroll.js')}}"></script>
<script src="{{asset('frontend/assets/js/main.js')}}"></script>

<script>
    var heroSlider = document.querySelector('#heroSlider');
    var carousel = new bootstrap.Carousel(heroSlider, {
        interval: 3000,  
        ride: 'carousel', 
        pause: false 
    });
</script>

@stack('frontend-js')

</body>

</html>
