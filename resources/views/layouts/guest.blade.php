<!DOCTYPE html>
<html dir={{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }} lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900">
    <div class="flex flex-col items-center min-h-screen pt-6 bg-green-100 sm:justify-center sm:pt-0 dark:bg-gray-900">
        <div>
            <a href="/">
                <x-application-logo :logo="asset('storage/' . $settings->site_logo)" class="w-20 h-20 text-gray-500 fill-current" />
            </a>
        </div>

        <div
            class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md dark:bg-gray-800 sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
