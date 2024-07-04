@props([
'title' => null,
'target',
'icon_only' => true,
'icon' => null
])

<a @class([ 'd-flex' ,'align-items-center' , 'justify-content-center p-2' ]) href="{{$target    }}">
    {{!is_null($title) ?: $title}}
    @if($icon_only)
    <x-icon name="{{$icon}}" />
    <!-- Live as if you were to die tomorrow. Learn as if you were to live forever. - Mahatma Gandhi -->
    @endif
</a>
