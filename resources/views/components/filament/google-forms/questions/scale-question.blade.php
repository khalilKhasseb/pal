@props(['props' , 'answer'])
@php
 $value = isset($answer[0]) ? $answer[0]['value'] : '';
@endphp
<div class="scale flex">
    <span @style([
        'margin-right:15px' => app()->getLocale() === 'en',
        'margin-left:15px' => app()->getLocale() === 'ar',
    ]) class="inline-block">{{ $props['highLabel'] }}</span>
    @for ($i = $props['low']; $i < $props['high']; $i++)
        <label class="flex flex-col items-center mx-2">
            <span>{{ $i }}</span>
            <input {{(int)$value === $i ? 'checked' : ''}} type="radio" value="{{ $i }}">
        </label>
    @endfor
    <span @style([
        'margin-left:15px' => app()->getLocale() === 'en',
        'margin-right:15px' => app()->getLocale() === 'ar',
    ]) class="inline-block ml-4">{{ $props['lowLabel'] }}</span>
</div>
