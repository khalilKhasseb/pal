@props(['year' => true , 'time' => false])


<input type="{{$time ? 'datetime-local' : 'date'}}">
