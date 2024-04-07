@props([
'title' => null,
'target',
'icon_only' => true,
'icon' => null
])

<a @class([ 'flex' ,'items-center' , 'justify-center p-2' ]) href="https://{{$target}}">
    {{!is_null($title) ?: $title}}
    @if($icon_only)
    <x-icon name="{{$icon}}" />
    <!-- Live as if you were to die tomorrow. Learn as if you were to live forever. - Mahatma Gandhi -->
    @endif
</a>