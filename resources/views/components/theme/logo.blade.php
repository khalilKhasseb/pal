@props([
    'url' => null,
    'route' => '/',
])

{{-- Recheck optional Pregmatch --}}
<a class="navbar-brand" href="{{ $route }}">
    <img src="{{ preg_match('/(http?s)/', $url) ? $url : asset('storage/' . $url) }}" alt="logo"
        class="img-responsive" />
</a>
