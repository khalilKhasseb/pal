<div>

    <x-theme.slide :gallaries="$gallaries" />
    <x-theme.hero-content />
    <x-theme.project :posts="$recent" />
    {{-- <x-theme.count /> --}}
    <x-theme.service :serviceBlocks="$serviceBlocks" />
    {{-- <x-theme.focus /> --}}
    {{-- <x-theme.campaian /> --}}
    {{-- <x-theme.collection /> --}}
    {{-- <x-theme.event /> --}}
    <x-theme.sponser :partners="$sponsers" />
    <x-theme.contact-us />
</div>
