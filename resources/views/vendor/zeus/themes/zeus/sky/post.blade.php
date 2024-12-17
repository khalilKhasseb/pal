@use(Illuminate\Support\Str)

@if (!is_null($post->coverInfo))
    <x-slot name="headerbg">
        {{ $post->coverInfo->cover() }}
    </x-slot>
ž
    <x-slot name='coverinfo'>
        <a href="{{ optional($post->coverInfo)->source }}" data-bs-toggle="tooltip"
            class="position-absolute top-0 {{ app()->getLocale() === 'ar' ? 'me-2 end-0' : 'ms-2 start-0' }}"
            title="{{ optional($post->coverInfo)->description }}">
            <span class="badge bg-info text-dark">{{ optional($post->coverInfo)->title }}</span>
        </a>
    </x-slot>
@endif

<x-slot name="header">
    <h3 class="capitalize">{{ $post->title }}</h3>
</x-slot>

<x-slot name="breadcrumbs">
    <li class="">
        @php
            $collection = ucfirst($post->post_type);
            $plural = Str::plural($collection);
            $route = $post->post_type === 'post' ? 'blogs' : $post->post_type;
        @endphp
        <a href="{{ route($route) }}">{{ __($plural) }}</a>
    </li>
    <li class="">{{ $post->title }}</li>
</x-slot>

@push('th3_scripts')
    <script type="text/javascript"
        src="https://platform-api.sharethis.com/js/sharethis.js#property=664c7db51783940019670c0e&product=inline-share-buttons&source=platform"
        async="async"></script>
@endpush


<section class="bg-single-blog">
    <div class="container">
        <div class="row">
            <div class="single-blog">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="blog-items">
                            @if ($post->image() !== null)
                                <div class="blog-img position-relative">
                                    {{ $post->getFirstMedia('posts') }}
                                    @if ($post->post_type === 'event')
                                        <div class="date-box">
                                            <h3>{{ $post->published_at->locale(app()->getLocale())->day }}</h3>
                                            <h5>{{ $post->published_at->locale(app()->getLocale())->monthName }}</h5>
                                        </div>
                                    @endif
                                </div>
                            @endif
                            <div class="blog-content-box">
                                <div class="meta-box">
                                    <div class="event-author-option">
                                        <div class="event-author-img">
                                            <img src="{{ \Filament\Facades\Filament::getUserAvatarUrl($post->author) }}"
                                                alt="avatar" />
                                        </div>
                                        <div class="event-author-name">
                                            <p>{{ __('Posted by') }} : <a
                                                    href="#">{{ $post->author->name ?? '' }}</a></p>
                                        </div>
                                    </div>
                                    <ul class="meta-post">
                                        <li><i class="fa fa-calendar" aria-hidden="true"></i>
                                            {{ optional($post->published_at)->format('Y-d-m') ?? '' }}
                                        </li>
                                    </ul>
                                </div>

                                <div class="blog-content">
                                    <h4>{{ $post->title }}</h4>

                                    <div class="tiptap-editor">
                                        <div class="tiptap-prosemirror-wrapper">
                                            <div class="ProseMirror">
                                                {!! $post->getContent() !!}
                                            </div>

                                        </div>
                                    </div>


                                    @if (!is_null($post->post_meta))
                                        <div class="mt-2 single-date-option clearfix">
                                            <ul class="single-date">
                                                @foreach ($post->post_meta as $meta)
                                                    <li class="d-flex justify-items-start">
                                                        @if ($meta->icon !== null)
                                                            <x-icon class="ps-2" width="20px" color="green"
                                                                name="{{ $meta->icon }}" />
                                                        @endif
                                                        <span>{{ $meta->key }} : {{ $meta->value }} </span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="clearfix"></div>
                                    @if (!is_null($post->gallary))
                                        <x-theme.gallary :gallary="$post->gallary->getMedia('gallary')" />
                                    @endif

                                    @if (!$post->getMedia('attachments')->isEmpty())
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">{{ __('Attachment') }}</th>
                                                    <th scope="col">{{ __('Download') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($post->getMedia('attachments') as $media)
                                                    <tr>
                                                        <th>{{ $media->getDownloadFilename() }}</th>
                                                        <td><a class="rounded btn-success btn"
                                                                href="{{ route('downloadAttachment', $media) }}">{{ __('Download') }}</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>

                                <div class="single-blog-bottom">
                                    <ul class="tags">
                                        <li><i class="fa fa-tags" aria-hidden="true"></i> {{ __('Tags') }} :</li>
                                        @unless ($post->tags->isEmpty())
                                            @foreach ($post->tags as $tag)
                                                @include($skyTheme . '.partial.tag')
                                            @endforeach
                                        @endunless
                                    </ul>
                                    <div class="event-share-option d-flex justify-items-start align-items-center">
                                        <span> {{ __('share') }} </span>
                                        <div class="sharethis-inline-share-buttons"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($post->has_contact_form)
                            <x-theme.contact-us :sub-heading="__(
                                'Professionally mesh enterprise wide imperatives without world class paradigms. Dynamically deliver ubiquitous leadership awesome skills.',
                            )" />
                        @endif

                        <div class="com">
                            @if ($settings->comments_enabled)
                                @livewire('comment', ['post' => $post])
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-4">
                        @include($skyTheme . '.partial.sidebar')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
