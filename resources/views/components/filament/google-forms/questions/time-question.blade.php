@props(['props','answer'])
@php

 $value = isset($answer[0]) ? $answer[0]['value'] : '00:00'
@endphp
<div class="time-input">
    <input value="{{$value}}" disabled type="time" class="border-none block w-full px-2">
</div>
