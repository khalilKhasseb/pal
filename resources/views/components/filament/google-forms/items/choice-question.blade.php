@props([
    'type' => 'checkbox',
    'options',
])
@if ($type !== 'drop_down')
    <div class="flex flex-row items-start align-center  gap-10">
        @foreach ($options as $option)
            <label class="mx-2" for="option{{ $loop->index }}">{{ $option['value'] }}</label>
            <input id="option-{{ $loop->index }}" type="{{ $type }}" value="{{ $option['value'] }}">
        @endforeach
    </div>

@endif

@if ($type === 'drop_down')
 <select  id="">
    @foreach($options as $option)
     <option value="{{$option['value']}}">{{$option['value']}}</option>
    @endforeach
 </select>
@endif
