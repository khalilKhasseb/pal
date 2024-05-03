@props(['props' , 'answer'])

@if (is_null($props['paragraph']))
    <h4>{{$answer[0]['value']}}</h4>
@else
    <p>{{$answer[0]['value']}}</p>
@endif
