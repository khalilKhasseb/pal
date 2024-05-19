<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="application-name" content="{{ config('app.name', 'Laravel') }}">

    <!-- Seo Tags -->
    <x-seo::meta />
    <!-- Seo Tags -->
     {{isset($frontscripts) ?$frontscripts : ''}}
    @if (app()->getLocale() === 'ar')
        <link data-layout="front" rel="preconnect" href="https://fonts.googleapis.com">
        <link data-layout="front" rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link data-layout="front" href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
            rel="stylesheet">
    @else
        <link data-layout="front" rel="preconnect" href="https://fonts.googleapis.com">
        <link data-layout="front" rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link data-layout="front"
            href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=KoHo:ital,wght@0,200;0,300;0,500;0,700;1,200;1,300;1,600;1,700&display=swap"
            rel="stylesheet">
    @endif
    {{-- @livewireStyles --}}
    {{-- @filamentStyles --}}
    @stack('styles')



    {{-- <link rel="stylesheet" href="{{ asset('vendor/zeus/frontend.css') }}"> --}}
    
    @if (!request()->routeIs('login', 'dashboard'))
        <link data-layout="front" rel="stylesheet" type="text/css" href="{{ asset('css/template/font-awesome.min.css') }}" media="all" />
        <link data-layout="front" rel="stylesheet" type="text/css" href="{{ asset('css/fonts/flaticon.css') }}" media="all" />
        <link data-layout="front" rel="stylesheet" type="text/css" href="{{ asset('css/template/bootstrap.min.css') }}" media="all" />
        <link data-layout="front" rel="stylesheet" type="text/css" href="{{ asset('css/template/animate.css') }}" media="all" />
        <link data-layout="front" rel="stylesheet" type="text/css" href="{{ asset('css/template/swiper.min.css') }}" media="all" />
        <link data-layout="front" rel="stylesheet" type="text/css" href="{{ asset('css/template/lightcase.css') }}" media="all" />
        <link data-layout="front" rel="stylesheet" type="text/css" href="{{ asset('css/template/jquery.nstSlider.css') }}"
            media="all" />
        <link data-layout="front" rel="stylesheet" type="text/css" href="{{ asset('css/template/flexslider.css') }}" media="all" />

        <!-- own style css -->
        <link data-layout="front" rel="stylesheet" type="text/css" href="{{ asset('css/template/style.css') }}?11ssdsad" media="all" />
        @if (app()->getLocale() === 'ar')
            <link data-layout="front" rel="stylesheet" type="text/css" href="{{ asset('css/template/rtl.css') }}?23dswdsa"
                media="all" />
        @endif
        <link data-layout="front" rel="stylesheet" type="text/css" href="{{ asset('css/template/responsive.css') }}" media="all" />
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
      
    </style>
    @vite('resources/js/app.js')
</head>
