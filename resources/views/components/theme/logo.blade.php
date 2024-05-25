@props([
'url' => null,
'route' => '/'
])

<a class="navbar-brand" href="{{$route}}"><img src="{{asset('storage/'.$url)}}" alt="logo"
        class="img-responsive" /></a>
