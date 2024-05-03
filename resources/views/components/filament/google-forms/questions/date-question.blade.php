@props(['props' , 'answer'])
@php
 $value =  $value = isset($answer[0]) ? $answer[0]['value'] : ''

@endphp
<div class="time-input">
    <input value="{{$value}}" disabled type="date" class="border-none block w-full px-2">
</div>
