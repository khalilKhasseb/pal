@props(['props', 'questionid','answer'])

@php
// $values = array_values($answer);
$values = [];
foreach ($answer as $key => $value) {
  $values[] = $value['value'];
}
@endphp

@if ($props['type'] !== 'DROP_DOWN')
    <div class="options-group">
        @foreach ($props['options'] as $option)
            <div class="option-item" id="{{ $questionid }}">
                <input {{in_array($option['value'] , $values) ? 'checked' :'ss'}} id="input-{{ $questionid }}" type="{{ $props['type'] }}" value="{{ $option['value'] }}" disabled
                    class="disabled:opacity-75">
                    {{-- @dump($option['value'] , $values , array_search($option['value'] , $values)) --}}

                <label class="ltr:ml-2 rtl:mr-2" for="input-{{ $questionid }}">{{ $option['value'] }}</label>
            </div>
        @endforeach
    </div>
@else
    <x-filament.google-forms.questions.drop-down :options="$props['options']" />
@endif
