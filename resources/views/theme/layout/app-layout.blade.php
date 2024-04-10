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
    <link rel="stylesheet" type="text/css" href="{{asset('css/template/style.css')}}?11sad" media="all" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/template/rtl.css')}}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/template/responsive.css')}}" media="all" />

    @vite(['resources/css/app.css' , 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>


<body id="page-top" data-spy="scroll">
    <div class="box-layout">


        {{-- Header start --}}

        @include('theme.partial.header' , [
        'logo' => Storage::url($settings->site_logo),
        ])
        {{-- Header Ends --}}

        <!-- Start page header -->

        @if(Route::current()->getName() !== 'theme.home')
        <!-- Start Page Header Section -->
        <section style="--header-bg:url({{Storage::url($settings->header_bg)}})" class="bg-page-header">
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
    {{-- <script type="text/javascript" src="{{asset('js/template/custom.map.js')}}"></script> --}}
    <script type="text/javascript" src="{{asset('js/template/custom.js')}}"></script>

    <!-- Map Api -->
    {{-- <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqVIkdttPNjl5c5hKlc_Hk3bfXQQlf2Rc&callback=initMap">


    </script> --}}
</body>

</html>