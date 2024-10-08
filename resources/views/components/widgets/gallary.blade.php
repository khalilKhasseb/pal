@props(['title', 'content'])
@php

    $id = (int) $content;

    $gm = App\Models\Gallary::find($id)->getMedia('gallary');

@endphp

<div class="footer-widgets">
    <div class="widgets-title">
        <h3>{{ $title }}</h3>
    </div>
    <!-- .widgets-title -->
    @if (!is_null($gm))
        <div class="footer-instagram">

            @foreach ($gm as $item)
                <a href="{{ $item->getUrl() }}" data-rel="lightcase:postGallary"><img src="{{ $item->getUrl() }}"
                        alt="footer-instagram-img-{{ $loop->index }}" /></a>
            @endforeach

        </div>
    @endif
    <!-- .footer-instagram -->
    <div class="clr"></div>
</div>
<!-- .footer-widgets -->
