@php
    $local = app()->getLocale();
    // dd($recent);
@endphp
<div>
    <x-theme.slide :gallaries="$gallaries" />
    <x-theme.hero-content :content-settings="$contentSettings" />
    <section class="bg-recent-project">
        <x-theme.project :sub-heading="$contentSettings['news_' . $local]" :posts="$recent" />
    </section>
    @if (session()->has('somoud_load'))
        <livewire:enviromental-days.list-days />
    @endif

    <livewire:newsletter />

    @if (session()->has('somoud_load'))
        <x-theme.sponser :sub-heading="$contentSettings['partners_' . $local]" :partners="$sponsers" />
    @endif

    {{-- <x-theme.contact-us :sub-heading="$contentSettings['contact_' . $local]" /> --}}
</div>
, bnm01 02bpnnph;;p9098