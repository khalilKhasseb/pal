@php
    $local = app()->getLocale();
    // dd($recent);
@endphp
<div>
    <x-theme.slide :gallaries="$gallaries" />
    <x-theme.hero-content :content-settings="$contentSettings" />

    <x-theme.project :sub-heading="$contentSettings['news_' . $local]" :posts="$recent" />
    {{-- <x-theme.count /> --}}
    
    {{-- <x-theme.service :serviceBlocks="$serviceBlocks" /> --}}
    {{-- <x-theme.focus /> --}}
    {{-- <x-theme.campaian /> --}}
    {{-- <x-theme.collection /> --}}
    {{-- <x-theme.event :event="$recent[0]" /> --}}

    @if (session()->has('somoud_load'))
        <x-theme.sponser :sub-heading="$contentSettings['partners_'.$local]" :partners="$sponsers" />
    @endif
    <x-theme.contact-us :sub-heading="$contentSettings['contact_' . $local]" />
</div>
