<div>

    <x-theme.slide :gallaries="$gallaries" />
    <x-theme.hero-content />
    <x-theme.project :posts="$recent" />
    {{-- <x-theme.count /> --}}
    {{-- <x-theme.service :serviceBlocks="$serviceBlocks" /> --}}
    {{-- <x-theme.focus /> --}}
    {{-- <x-theme.campaian /> --}}
    {{-- <x-theme.collection /> --}}
    {{-- <x-theme.event /> --}}
    @if($sommod)
    <x-theme.sponser :partners="$sponsers" />
    @endif
    <x-theme.contact-us />
</div>
