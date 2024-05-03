@props(['options'])

<div>
    <select name="" id="">
        @foreach ($options as $option)
            <option value="{{ $option['value'] }}">{{ $option['value'] }}</option>
        @endforeach
    </select>
</div>
