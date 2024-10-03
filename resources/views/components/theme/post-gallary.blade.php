@props(['gallary', 'slug'])

<div class="my-5">

    <!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->
    <div class="container">
        <div class="row">
            @foreach ($gallary->getMedia('gallary') as $item)
                <div class="item col-12 col-md-4 col-lg-3">
                    <a href="{{ $item->getFullUrl() }}" data-rel="{{ 'lightcase:' . $slug }}">
                        <img src="{{ $item->getFullUrl() }}" alt="{{ $gallary->title }}">
                    </a>
                </div>
            @endforeach
        </div>
    </div>

</div>
