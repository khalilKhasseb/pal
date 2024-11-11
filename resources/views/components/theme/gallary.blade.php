@props(['gallary'])


<div class="gallary-wrapper mb-5">

    <div class="row gab-5">
        @foreach ($gallary as $media)
            <div class="item col-lg-3 col-md-3 col-sm-6">
                <a style="width:100%;height:150px" class="block" href="{{ $media->getFullUrl() }}" data-rel="lightcase:postGallary">
                    <img style="height:100%;" src="{{ $media->getFullUrl() }}" class="object-fit-cover"/>
                </a>
            </div>
        @endforeach
    </div>
</div>
