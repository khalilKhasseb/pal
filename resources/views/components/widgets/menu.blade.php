@use(\App\Theme\ThemeRenderNaveItem)
@props(['content' , 'title']);

@php

    $menu = App\Models\Blog\Navigation::find($content);
@endphp

<div class="footer-widgets">
    <!-- .widgets-title -->
    <div class="widgets-title">
        <h3>{{ $title }}</h3>
    </div>

    <ul class="pages-menu">
        @foreach ($menu->items as $item)
            <li>
                {!! ThemeRenderNaveItem::render($item, false, 'text-white h5  ') !!}
            </li>
        @endforeach

    </ul> <!-- .footer-instagram -->
</div>

<!-- .footer-widgets -->

