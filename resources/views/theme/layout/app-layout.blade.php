<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ __('filament-panels::layout.direction') ?? 'ltr' }}" class="antialiased filament js-focus-visible">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="application-name" content="{{ config('app.name', 'Laravel') }}">

    <!-- Seo Tags -->
    <x-seo::meta />
    <!-- Seo Tags -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=KoHo:ital,wght@0,200;0,300;0,500;0,700;1,200;1,300;1,600;1,700&display=swap"
        rel="stylesheet">

    @livewireStyles
    @filamentStyles
    @stack('styles')



    {{--
    <link rel="stylesheet" href="{{ asset('vendor/zeus/frontend.css') }}"> --}}

    <link rel="stylesheet" type="text/css" href="{{asset('css/template/font-awesome.min.css')}}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/fonts/flaticon.css')}}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/template/bootstrap.min.css')}}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/template/animate.css')}}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/template/swiper.min.css')}}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/template/lightcase.css')}}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/template/jquery.nstSlider.css')}}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/template/flexslider.css')}}" media="all" />

    <!-- own style css -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/template/style.css')}}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/template/rtl.css')}}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/template/responsive.css')}}" media="all" />

    @vite('resources/css/app.css')

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>


<body id="page-top" data-spy="scroll">
    <div class="box-layout">
        <div class="box-style">
            <div class="color-btn">
                <a href="#"><i class="fa fa-cog fa-spin" aria-hidden="true"></i></a>
            </div>
            <div class="box-style-inner">
                <h3>Box Layout</h3>
                <div class="box-element">
                    <div class="box-heading">
                        <h5>HTML Layout</h5>
                    </div>
                    <div class="box-content">
                        <ul class="box-customize">
                            <li><a class="boxed-btn" href="#">Boxed</a></li>
                            <li><a class="wide-btn" href="#">Wide</a></li>
                            <li><a class="rtl-btn" href="#">Rtl</a></li>
                            <li><a class="ltl-btn" href="#">Ltl</a></li>
                        </ul>
                    </div>
                </div>
                <div class="box-element">
                    <div class="box-heading">
                        <h5>Backgroud Images</h5>
                    </div>
                    <div class="box-content">
                        <ul class="box-bg-img">
                            <li>
                                <a class="bg-1" href="#"><img src="/images/box-style/01.jpg" alt=""></a>
                            </li>


                            {{-- <li>
                                <a class="bg-2" href="#"><img src="assets/images/box-style/02.jpg" alt=""></a>
                            </li>
                            <li>
                                <a class="bg-3" href="#"><img src="assets/images/box-style/03.jpg" alt=""></a>
                            </li>
                            <li>
                                <a class="bg-4" href="#"><img src="assets/images/box-style/04.jpg" alt=""></a>
                            </li>
                            <li>
                                <a class="bg-5" href="#"><img src="assets/images/box-style/05.jpg" alt=""></a>
                            </li>
                            <li>
                                <a class="bg-6" href="#"><img src="assets/images/box-style/06.jpg" alt=""></a>
                            </li>
                            <li>
                                <a class="bg-7" href="#"><img src="assets/images/box-style/07.jpg" alt=""></a>
                            </li>
                            <li>
                                <a class="bg-8" href="#"><img src="assets/images/box-style/08.jpg" alt=""></a>
                            </li> --}}
                        </ul>
                    </div>
                </div>
                <div class="box-element">
                    <div class="box-heading">
                        <h5>Backgroud Pattern</h5>
                    </div>
                    <div class="box-content">
                        <ul class="box-pattern-img">
                            <li>
                                <a class="pt-1" href="#"><img
                                        src="https://www.codexcoder.com/images/auror/pt-image/01.png" alt=""></a>
                            </li>
                            <li>
                                <a class=" pt-2" href="#"><img
                                        src="https://www.codexcoder.com/images/auror/pt-image/02.png" alt=""></a>
                            </li>
                            <li>
                                <a class=" pt-3" href="#"><img
                                        src="https://www.codexcoder.com/images/auror/pt-image/03.png" alt=""></a>
                            </li>
                            <li>
                                <a class=" pt-4" href="#"><img
                                        src="https://www.codexcoder.com/images/auror/pt-image/04.png" alt=""></a>
                            </li>
                            <li>
                                <a class=" pt-5" href="#"><img
                                        src="https://www.codexcoder.com/images/auror/pt-image/05.png" alt=""></a>
                            </li>
                            <li>
                                <a class=" pt-6" href="#"><img
                                        src="https://www.codexcoder.com/images/auror/pt-image/06.png" alt=""></a>
                            </li>
                            <li>
                                <a class=" pt-7" href="#"><img
                                        src="https://www.codexcoder.com/images/auror/pt-image/07.png" alt=""></a>
                            </li>
                            <li>
                                <a class=" pt-8" href="#"><img
                                        src="https://www.codexcoder.com/images/auror/pt-image/08.png" alt=""></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        {{-- Header start --}}

        @include('theme.partial.header' , [
          'logo' => Storage::url($settings->site_logo),
        ])
        {{-- Header Ends --}}

        <!-- Start page header -->

        @if(Route::current()->getName() !== 'theme.home')
        <!-- Start Page Header Section -->
        <section class="bg-page-header">
            <div class="page-header-overlay">
                <div class="container">
                    <div class="row">
                        <div class="page-header">


                            @if(isset($header))
                            <div class="page-title">
                                {{$header}}
                            </div>

                            @endif
                            <!-- .page-title -->

                            @if(isset($breadcrumbs))
                            <div class="page-header-content">
                                <ol class="breadcrumb">
                                    {{ $breadcrumbs }}

                                </ol>
                            </div>
                            @endif
                            <!-- .page-header-content -->
                        </div>
                        <!-- .page-header -->
                    </div>
                    <!-- .row -->
                </div>
                <!-- .container -->
            </div>
            <!-- .page-header-overlay -->
        </section>
        <!-- End Page Header Section -->
        <!-- End page header -->
        @endif

        {{-- Content area --}}
        {{$slot}}
        {{-- End content area --}}
        <!-- Start Scrolling -->
        <div class="scroll-img"><i class="fa fa-angle-up" aria-hidden="true"></i></div>
        <!-- End Scrolling -->

        @include('theme.partial.footer')

    </div>

    <!-- Start Pre-Loader-->

    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="object" id="object_one"></div>
                <div class="object" id="object_two"></div>
                <div class="object" id="object_three"></div>
                <div class="object" id="object_four"></div>
            </div>
        </div>
    </div>


    <!-- End Pre-Loader -->


    <script type="text/javascript" src="{{asset('js/template/jquery-2.2.3.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/template/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/template/jquery.easing.1.3.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/template/jquery.waypoints.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/template/jquery.counterup.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/template/swiper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/template/plugins.isotope.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/template/isotope.pkgd.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/template/lightcase.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/template/jquery.nstSlider.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/template/jquery.flexslider.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/template/custom.isotope.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/template/custom.map.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/template/custom.js')}}"></script>

    <!-- Map Api -->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqVIkdttPNjl5c5hKlc_Hk3bfXQQlf2Rc&callback=initMap">


    </script>
</body>

</html>
