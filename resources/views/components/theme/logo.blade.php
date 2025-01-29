@props([
'url' => null,
'route' => '/'
])

@php
   
    if(!Storage::disk('public')->exists('/site\/'.basename($url))) {
        $url = config('theme.console_logo');        
    }

    
    
@endphp


{{-- Recheck optional Pregmatch --}}
<a class="navbar-brand" href="{{$route}}">
    <img src="{{preg_match('/(http?s)/' , $url) ? $url : asset('storage/'.$url)}}" alt="logo"
        class="img-responsive" />
    </a>
