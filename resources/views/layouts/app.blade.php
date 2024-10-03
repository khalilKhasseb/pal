<!DOCTYPE html>
<html dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('fv/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('fv/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('fv/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('fv/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('fv/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    @if (app()->getLocale() === 'ar')
        <link data-layout="front" rel="preconnect" href="https://fonts.googleapis.com">
        <link data-layout="front" rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link data-layout="front"
            href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
            rel="stylesheet">

        <style>
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
    @else
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @endif
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
