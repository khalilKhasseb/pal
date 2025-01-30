@props([
    'url' => null,
    'route' => '/',
])

@php

    if (!Storage::disk('storage')->exists('/site\/' . basename($url))) {
        dd($url);
        if (session()->has('somoud_load')) {
            $url = config('theme.samoud_logo');
        } else {
            $url = config('theme.console_logo');
        }
    }

@endphp


{{-- Recheck optional Pregmatch --}}
<a class="navbar-brand" href="{{ $route }}">
    <img src="{{ preg_match('/(http?s)/', $url) ? $url : asset('storage/' . $url) }}" alt="logo"
        class="img-responsive" />
</a>
