@props(['member'])
<div class="col-lg-3 col-sm-6 col-12">
    <div class="volunteers-items">
        <div class="volunteers-img">
            <img src="{{ $member->image() }}" alt="volunteers-img-1" class="img-responsive" />
        </div>
        <!-- .volunteers-img -->
        <div class="volunteers-content">
            <h4 class="mb-2"><a
                    href="{{ route('administration.view', ['slug' => $member->slug]) }}">{{ $member->title }}</a></h4>
            @if ($member->post_meta !== null)
                @foreach ($member->post_meta as $meta)
                    <p>{{ $meta->value }}</p>
                @endforeach
            @endif
        </div>
        <!-- .volunteers-content -->
        @if (!is_null($member->links))
            <div class="volunteers-social-icon">
                <ul class="social-icon">

                    @foreach ($member->links as $link)
                        <li>
                            <a href="https://www.{{ $link->url }}" target="_blank">
                                @if (!is_null($link->icon) && !empty($link->icon))
                                    <x-icon class="ps-2" width="25px" color="{{ $link->color }}"
                                        name="{{ $link->icon }}" />
                                @endif
                            </a>
                        </li>
                    @endforeach



                </ul>

            </div>
        @endif
        <!-- .volunteers-social-icon -->
    </div>
    <!-- .volunteers-items -->
</div>
