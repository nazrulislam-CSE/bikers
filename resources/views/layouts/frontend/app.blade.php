<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ env('APP_NAME') }} | {{ $pageTitle ?? '' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('frontend/images/svg/logo.svg') }}" />
    <link href="{{ asset('frontend/css/master.css') }}" rel="stylesheet">

    <!-- SWITCHER -->
    <link rel="stylesheet" id="switcher-css" type="text/css"
        href="{{ asset('frontend/assets/switcher/css/switcher.css') }}" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{ asset('frontend/assets/switcher/css/color1.css') }}"
        title="color1" media="all" data-default-color="true" />
    <link rel="alternate stylesheet" type="text/css" href="{{ asset('frontend/assets/switcher/css/color2.css') }}"
        title="color2" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{ asset('frontend/assets/switcher/css/color3.css') }}"
        title="color3" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{ asset('frontend/assets/switcher/css/color4.css') }}"
        title="color4" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="{{ asset('frontend/assets/switcher/css/color5.css') }}"
        title="color5" media="all" />

</head>

<body>
    <!-- Loader -->
    <div id="page-preloader"><span class="spinner"></span></div>
    <!-- Loader end -->

    <!-- Start Switcher -->
    <div class="switcher-wrapper">
        <div class="demo_changer">
            <div class="demo-icon customBgColor"><i class="fa fa-cog fa-spin fa-2x"></i></div>
            <div class="form_holder">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="predefined_styles">
                            <div class="skin-theme-switcher">
                                <h4>Color</h4>
                                <a href="#" data-switchcolor="color1" class="styleswitch"
                                    style="background-color:#ce0000;"> </a>
                                <a href="#" data-switchcolor="color2" class="styleswitch"
                                    style="background-color:#4fb0fd;"> </a>
                                <a href="#" data-switchcolor="color3" class="styleswitch"
                                    style="background-color:#ffc73c;"> </a>
                                <a href="#" data-switchcolor="color4" class="styleswitch"
                                    style="background-color:#ff8300;"> </a>
                                <a href="#" data-switchcolor="color5" class="styleswitch"
                                    style="background-color:#02cc8b;"> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Switcher -->

    <!-- header start -->
    @include('layouts.frontend.navbar')
    <!-- header end -->
    
    @yield('content')

    <!-- footer start -->
    @include('layouts.frontend.footer')
    <!-- footer start -->
   
    <!--Main-->
    <script src="{{ asset('frontend/js/jquery-1.11.3.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/modernizr.custom.js') }}"></script>
    <!--Counter-->
    <script src="{{ asset('frontend/assets/rendro-easy-pie-chart/dist/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('frontend/js/classie.js') }}"></script>
    <!--Switcher-->
    <script src="{{ asset('frontend/assets/switcher/js/switcher.js') }}"></script>
    <!--Owl Carousel-->
    <script src="{{ asset('frontend/assets/owl-carousel/owl.carousel.min.js') }}"></script>
    <!--bxSlider-->
    <script src="{{ asset('frontend/assets/bxslider/jquery.bxslider.min.js') }}"></script>
    <!-- jQuery UI Slider -->
    <script src="{{ asset('frontend/assets/slider/jquery.ui-slider.js') }}"></script>
    <!--Isotope-->
    <script src="{{ asset('frontend/assets/isotope/isotope.js') }}"></script>
    <!--Slider-->
    <script src="{{ asset('frontend/assets/slider/jquery.ui-slider.js') }}"></script>
    <!--Fancybox-->
    <script src="{{ asset('frontend/assets/fancybox/jquery.fancybox.pack.js') }}"></script>
    <!--Theme-->
    <script src="{{ asset('frontend/js/jquery.smooth-scroll.js') }}"></script>
    <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.placeholder.min.js') }}"></script>
    <script src="{{ asset('frontend/js/theme.js') }}"></script>
</body>

</html>
