@if (!is_null($post->coverInfo))
    <x-slot name="headerbg">
        {{ $post->coverInfo->cover() }}
    </x-slot>

    <x-slot name='coverinfo'>
        <a href="{{ $post->coverInfo->source }}" data-bs-toggle="tooltip"
            class="position-absolute top-0  {{ app()->getLocale() === 'ar' ? 'me-2 end-0' : 'ms-2 start-0' }}"
            title="{{ $post->coverInfo->description }}"><span
                class="badge bg-info text-dark">{{ $post->coverInfo->title }}</span></a>
    </x-slot>
@endif

<x-slot name="header">
    <h2 class="capitalize">{{ $post->title }}</h2>
</x-slot>

<x-slot name="breadcrumbs">
    <li class="">
        <a href="{{ route('theme.home') }}">{{ __('Home') }}</a>
        {{-- @svg('iconpark-rightsmall-o','fill-current w-4 h-4 mx-3 rtl:rotate-180') --}}
    </li>
    <li class="">
        {{ $post->title }}
    </li>
</x-slot>
@push('th3_scripts')
    <script type="text/javascript"
        src="https://platform-api.sharethis.com/js/sharethis.js#property=664c7db51783940019670c0e&product=inline-share-buttons&source=platform"
        async="async"></script>
@endpush


<section class="bg-single-blog">

    <div class="container mb-5">
        <div class="row">
            <div class="single-blog">
                <div class="row">
                    <div class="col-12">
                        <div class="blog-items">
                            @if ($post->image('pages') !== null)
                                {{-- @dd($post->image()) --}}
                                {{-- <div class="blog-img">
                                <a href="#">
                                    <img src="{{$post->image('pages')}}" alt="{{$post->title}}" class="img-responsive" />
                                </a>
                            </div> --}}
                            @endif
                            <!-- .blog-img -->
                            <div class="blog-content-box" style="border-top: 1px solid #f0f0f0">

                                {{-- <div class="meta-box" style="border-top:1px solid #f0f0f0">
                                    <div class="event-author-option">
                                        <div class="event-author-img">
                                            <img src="{{\Filament\Facades\Filament::getUserAvatarUrl($post->author) }}"
                                                alt="avatar" />
                                        </div>
                                        <!-- .author-img -->
                                        <div class="event-author-name">
                                            <p>{{__('Posted by')}} : <a href="#">{{$post->author->name ?? ""}}</a></p>
                                        </div>
                                        <!-- .author-name -->
                                    </div>
                                    <!-- .author-option -->
                                    <ul class="meta-post">
                                        <li><i class="fa fa-calendar" aria-hidden="true"></i>
                                            {{ optional($post->published_at)->diffForHumans() ?? '' }}
                                            <!-- 22.04.2017 -->
                                        </li>
                                        <li x-data="
                                        {
                                            likes:@js($post->likes),
                                            post_id:@js($post->id),
                                            liked : @js($post->checkIfHasLikeForThisIp(request()->getClientIp())),
                                            like_post(){
                                              axios.get('{{route('ajax.like_post',$post->slug)}}')
                                              .then(r => {
                                                console.log(r)
                                                if(r.data) this.likes = r.data.likes
                                              })
                                              .catch(e => console.log(e))
                                            }

                                        }
                                        ">
                                            <button x-on:click="console.log(1)" class="btn-transparent" style="background:transparent">
                                                <i   class="fa fa-heart-o" aria-hidden="true"></i> <span
                                                    x-text="likes === null ? 0 : likes"></span>
                                            </button>

                                        </li>

                                    </ul>
                                </div> --}}


                                <!-- .meta-box -->
                                <div class="blog-content">
                                    <h4 class="text-center">{{ $post->title }}</h4>
                                    {!! $post->getContent() !!}
                                    @if (!is_null($post->gallary))
                                        <x-theme.post-gallary :gallary="$post->gallary" :slug="$post->slug" />
                                    @endif
                                    @if (!$post->getMedia('attachments')->isEmpty())
                                        <table class="table mt-5 table-bordered">
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



                                    @if ($post->form !== null)
                                        <iframe id="{{ $post->form->id }}" title="{{ $post->form->name }}"
                                            src="{{ $post->form->responder_uri }}" width="100%" height="1200px">
                                        </iframe>
                                    @endif

                                    {{-- @if (!is_null($post->gallary))
                                        <x-theme.gallary :gallary="$post->gallary->getMedia('*')" />
                                    @endif --}}
                                </div>
                                <!-- .blog-content -->
                                <div class="single-blog-bottom">
                                    {{-- <ul class="tags">
                                        <li><i class="fa fa-tags" aria-hidden="true"></i> {{ __('Tags') }} :</li>
                                        @unless ($post->tags->isEmpty())
                                            @foreach ($post->tags->where('type', 'tag') as $tag)
                                                @include($skyTheme . '.partial.tag')
                                            @endforeach
                                        @endunless
                                    </ul> --}}
                                    <!-- .author-option -->
                                    <div class="event-share-option d-flex justify-items-start align-items-center">


                                        <span> {{ __('share') }} </span>
                                        <div class="sharethis-inline-share-buttons"></div>
                                    </div>
                                    <!-- .share-option -->
                                </div>
                                <!-- .single-blog-bottom -->
                            </div>
                            <!-- .blog-content-box -->
                        </div>
                        @if ($post->has_contact_form)
                            <x-theme.contact-us :sub-heading="__(
                                'Professionally mesh enterprise wide imperatives without world class paradigms.Dynamically deliver ubiquitous leadership awesome skills.',
                            )" />
                            @endif @if ($settings->comments_enabled)
                                <div class="comments-option" x-data="{
                                    comments: @js($post->comments)
                                }">
                                    <h4 class="comments-title">
                                        {{ $post->comments->count() > 0 ? $post->comments->count : '' }}
                                        {{ __('comments') }}</h4>

                                    @foreach ($post->comments as $comment)
                                        @if (!empty($comment->comment) && !empty($comment->comment))
                                            <div class="comments-items">
                                                <div class="comments-image">
                                                    <img src="{{ config('theme.defaultCommentAuthorImage') }}"
                                                        alt="comments-author-img" />
                                                </div>
                                                <!-- .comments-image -->
                                                <div class="comments-content">
                                                    <div class="comments-author-title">
                                                        <div class="comments-author-name">
                                                            <h4><a href="#">{{ $comment->name }}</a> -
                                                                <small>{{ optional($comment->created_at)->diffForHumans() }}</small>
                                                            </h4>
                                                        </div>
                                                        {{-- <div class="reply-icon">
                                            <h6><i class="fa fa-reply-all"></i><a href="#"> Reply</a></h6>
                                        </div> --}}
                                                    </div>
                                                    <!-- .comments-author-title -->
                                                    <p>{{ $comment->comment }}</p>
                                                </div>
                                                <!-- .comments-content -->
                                            </div>
                                            <!-- .comments-items -->
                                        @endif
                                    @endforeach

                                </div>
                                <!-- .comments-option -->

                                @livewire('comment', ['post' => $post])
                            @endif
                    </div>

                    {{-- <div class="col-lg-4">

                        @include($skyTheme.'.partial.sidebar')

                        <!-- .sidebar -->
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
