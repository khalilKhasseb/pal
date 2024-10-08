<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ __('filament-panels::layout.direction') ?? 'ltr' }}"
    class="antialiased filament js-focus-visible">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        //$siteTitle = !is_null($settings->site_name) ? $settings->site_name : config('app.name', 'Palgpc');
        $siteTitle =
            app()->getLocale() === 'ar'
                ? $settings->ar_site_name
                : (!is_null($settings->site_name)
                    ? $settings->site_name
                    : config('app.name', 'Palgpc'));

        $description =
            app()->getLocale() === 'ar'
                ? $settings->ar_site_description
                : (!is_null($settings->site_description)
                    ? $settings->site_description
                    : config('app.name', 'Palgpc'));

    @endphp
    <meta name="application-name" content="{{ $siteTitle }}">
    <meta name="description" content="{{ $description }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('fv/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('fv/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('fv/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('fv/site.webmanifest')}}">
    <link rel="mask-icon" href="{{asset('fv/safari-pinned-tab.svg')}}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <title>{{ $siteTitle }}</title>
    <!-- Seo Tags -->
    <x-seo::meta />
    <!-- Seo Tags -->
    @if (app()->getLocale() === 'ar')
        <link data-layout="front" rel="preconnect" href="https://fonts.googleapis.com">
        <link data-layout="front" rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link data-layout="front"
            href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
            rel="stylesheet">
    @else
        <link data-layout="front" rel="preconnect" href="https://fonts.googleapis.com">
        <link data-layout="front" rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link data-layout="front"
            href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=KoHo:ital,wght@0,200;0,300;0,500;0,700;1,200;1,300;1,600;1,700&display=swap"
            rel="stylesheet">
    @endif
    @livewireStyles
    {{-- @filamentStyles --}}
    @stack('styles')
    @stack('th3_scripts')



    @if (!request()->routeIs('login', 'dashboard'))
        <link data-layout="front" rel="stylesheet" type="text/css"
            href="{{ asset('css/template/font-awesome.min.css') }}" media="all" />
        <link data-layout="front" rel="stylesheet" type="text/css" href="{{ asset('css/fonts/flaticon.css') }}"
            media="all" />
        <link data-layout="front" rel="stylesheet" type="text/css" href="{{ asset('css/template/bootstrap.min.css') }}"
            media="all" />
        <link data-layout="front" rel="stylesheet" type="text/css" href="{{ asset('css/template/animate.css') }}"
            media="all" />
        <link data-layout="front" rel="stylesheet" type="text/css" href="{{ asset('css/template/swiper.min.css') }}"
            media="all" />
        <link data-layout="front" rel="stylesheet" type="text/css" href="{{ asset('css/template/lightcase.css') }}"
            media="all" />
        <link data-layout="front" rel="stylesheet" type="text/css"
            href="{{ asset('css/template/jquery.nstSlider.css') }}" media="all" />
        <link data-layout="front" rel="stylesheet" type="text/css" href="{{ asset('css/template/flexslider.css') }}"
            media="all" />

        <!-- own style css -->
        <link data-layout="front" rel="stylesheet" type="text/css"
            href="{{ asset('css/template/style.css') }}?v1.0.0" media="all" />
        @if (app()->getLocale() === 'ar')
            <link data-layout="front" rel="stylesheet" type="text/css"
                href="{{ asset('css/template/rtl.css') }}?v1.0.0" media="all" />
        @endif
        <link data-layout="front" rel="stylesheet" type="text/css"
            href="{{ asset('css/template/responsive.css') }}" media="all" />
    @endif


    <style data-layout="front">
        .filament-tiptap-grid-builder {
            display: grid;
        }

        [x-cloak] {
            display: none !important;
        }


        * {
            font-family: "Rubik", sans-serif;

        }

        .fontrubib {
            font-family: "Rubik", sans-serif;
            font-optical-sizing: auto;
            font-weight: normal;
            font-style: normal;
        }

        :required {
            position: relative;

        }

        .required:after {
            content: "*";
            color: red
        }

        .navbar-brand {
            max-width: 100px
        }
    </style>
    @vite('resources/js/app.js')
</head>

<body class="{{ app()->getLocale() === 'ar' ? 'rtl' : '' }} " id="page-top" data-spy="scroll">
    <div class="box-layout">



        @livewire('header')
        {{-- Header Ends --}}

        <!-- Start page header -->


        @if (
            !is_null(Route::current()) &&
                Route::current()->getName() !== 'theme.home' &&
                Route::current()->getName() !== 'front.somoud.home')

            <!-- Start Page Header Section -->
            <section style="--header-bg:url({{ Storage::url($settings->header_bg) }})" class="bg-page-header">
                <div class="page-header-overlay">
                    <div class="container">
                        <div class="row">
                            <div class="page-header">


                                @if (isset($header))
                                    <div class="page-title">
                                        {{ $header }}
                                    </div>
                                @endif
                                <!-- .page-title -->

                                @if (isset($breadcrumbs))
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
        {{ $slot }}
    </div>
    {{-- End content area --}}
    <!-- Start Scrolling -->
    <div class="scroll-img"><i class="fa fa-angle-up" aria-hidden="true"></i></div>
    <!-- End Scrolling -->

    @include('theme.partial.footer')

    </div>

    <!-- Start Pre-Loader-->

    {{-- <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="object" id="object_one"></div>
                <div class="object" id="object_two"></div>
                <div class="object" id="object_three"></div>
                <div class="object" id="object_four"></div>
            </div>
        </div>
    </div> --}}


    <!-- End Pre-Loader -->


    <script data-layout="front" type="text/javascript" src="{{ asset('js/template/jquery-2.2.3.min.js') }}"></script>
    <script data-layout="front" type="text/javascript" src="{{ asset('js/template/bootstrap.min.js') }}"></script>
    <script data-layout="front" type="text/javascript" src="{{ asset('js/template/jquery.easing.1.3.js') }}"></script>
    <script data-layout="front" type="text/javascript" src="{{ asset('js/template/jquery.waypoints.min.js') }}"></script>
    <script data-layout="front" type="text/javascript" src="{{ asset('js/template/jquery.counterup.min.js') }}"></script>
    <script data-layout="front" type="text/javascript" src="{{ asset('js/template/swiper.min.js') }}"></script>
    {{-- <script data-layout="front" type="text/javascript" src="{{ asset('js/template/plugins.isotope.js') }}"></script> --}}
    {{-- <script data-layout="front" type="text/javascript" src="{{ asset('js/template/isotope.pkgd.min.js') }}"></script> --}}
    <script data-layout="front" type="text/javascript" src="{{ asset('js/template/lightcase.js') }}"></script>
    <script data-layout="front" type="text/javascript" src="{{ asset('js/template/jquery.nstSlider.js') }}"></script>
    <script data-layout="front" type="text/javascript" src="{{ asset('js/template/jquery.flexslider.js') }}"></script>
    {{-- <script data-layout="front" type="text/javascript" src="{{ asset('js/template/custom.isotope.js') }}"></script> --}}
    {{-- <script type="text/javascript" src="{{asset('js/template/custom.map.js')}}"></script> --}}
    <script data-layout="front" type="text/javascript" src="{{ asset('js/template/custom.js') }}"></script>
    @stack('scripts_comp')
    <!-- Map Api -->
    {{-- <script data-layout="front" async defer
     src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqVIkdttPNjl5c5hKlc_Hk3bfXQQlf2Rc&callback=initMap"></script> --}}

</body>

</html>
