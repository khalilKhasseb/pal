@props(['gallary'])

<div>
    <div class="gallary-wrapper mb-5">


        @foreach ($gallary as $media)
            <div class="item">
                <a href="{{ $media->getFullUrl() }}" data-rel="lightcase:postGallary">
                   
                </a>
            </div>
        @endforeach
    </div>
</div>
