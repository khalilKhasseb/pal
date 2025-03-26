@use(Illuminate\Support\Str)

@if (!is_null($post->coverInfo))
    <x-slot name="headerbg">
        {{ $post->coverInfo->cover() }}
    </x-slot>

    <x-slot name='coverinfo'>
        <a href="{{ optional($post->coverInfo)->source }}" data-bs-toggle="tooltip"
            class="position-absolute top-0 {{ app()->getLocale() === 'ar' ? 'me-2 end-0' : 'ms-2 start-0' }}"
            title="{{ optional($post->coverInfo)->description }}">
            <span class="badge bg-accent">{{ optional($post->coverInfo)->title }}</span>
        </a>
    </x-slot>
@endif

<x-slot name="header">
    <h3 class="header-title">{{ $post->title }}</h3>
</x-slot>

<x-slot name="breadcrumbs">
    <li class="breadcrumb-item">
        <a href="{{ route('theme.home') }}">{{ __('Home') }}</a>
    </li>
    <li class="breadcrumb-item">
        @php
            $collection = ucfirst($post->post_type);
            $plural = Str::plural($collection);
            $route = $post->post_type === 'post' ? 'blogs' : $post->post_type;
        @endphp
        <a href="{{ route($route) }}">{{ __($plural) }}</a>
    </li>
    <li class="breadcrumb-item active">{{ $post->title }}</li>
</x-slot>

@push('th3_scripts')
    <script type="text/javascript"
        src="https://platform-api.sharethis.com/js/sharethis.js#property=664c7db51783940019670c0e&product=inline-share-buttons&source=platform"
        async="async"></script>
@endpush

<section class="single-post-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Main Content -->
                <article class="single-post-content">
                    <!-- Featured Image -->
                    @if ($post->image() !== null)
                        <div class="featured-image-container">
                            {{ $post->getFirstMedia('posts') }}
                            
                            <!-- Event Date Box -->
                            @if ($post->post_type === 'event')
                                <div class="event-date-box">
                                    <div class="date-inner">
                                        <div class="day">{{ $post->published_at->locale(app()->getLocale())->day }}</div>
                                        <div class="month">{{ $post->published_at->locale(app()->getLocale())->monthName }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Post Content Container -->
                    <div class="blog-content-wrapper">
                        <!-- Author and Meta Information -->
                        <div class="meta-box">
                            <div class="event-author-option">
                                <div class="event-author-img">
                                    <img src="{{ \Filament\Facades\Filament::getUserAvatarUrl($post->author) }}"
                                        alt="{{ $post->author->name ?? '' }}" />
                                </div>
                                <div class="event-author-name">
                                    <p>{{ __('Posted by') }} : <a href="#">{{ $post->author->name ?? '' }}</a></p>
                                </div>
                            </div>
                            <ul class="meta-post">
                                <li>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    {{ optional($post->published_at)->format('M d, Y') ?? '' }}
                                </li>
                                <li x-data="{
                                    likes: @js($post->likes ?? 0),
                                    post_id: @js($post->id),
                                    liked: @js($post->checkIfHasLikeForThisIp(request()->getClientIp())),
                                    like_post() {
                                        axios.get('{{ route('ajax.like_post', $post->id) }}')
                                            .then(r => {
                                                if (r.data) {
                                                    this.likes = r.data.likes
                                                    this.liked = r.data.liked
                                                }
                                            })
                                            .catch(e => console.log(e))
                                    }
                                }">
                                    <button x-on:click="like_post" class="like-button" :class="{ 'liked': liked }">
                                        <i class="fa" :class="liked ? 'fa-heart' : 'fa-heart-o'" aria-hidden="true"></i>
                                        <span class="like-count" x-text="likes === null ? 0 : likes"></span>
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <!-- Post Content -->
                        <div class="blog-content">
                            <h4 class="post-title">{{ $post->title }}</h4>

                            <!-- Rich Text Content -->
                            <div class="tiptap-editor">
                                <div class="tiptap-prosemirror-wrapper">
                                    <div class="ProseMirror">
                                        {!! $post->getContent() !!}
                                    </div>
                                </div>
                            </div>

                            <!-- Post Meta Information -->
                            @if (!is_null($post->post_meta))
                                <div class="post-meta-info">
                                    <h4 class="meta-section-title">{{ __('Additional Information') }}</h4>
                                    <div class="single-date-option clearfix">
                                        <ul class="single-date">
                                            @foreach ($post->post_meta as $meta)
                                                <li class="meta-item">
                                                    @if ($meta->icon !== null)
                                                        <div class="meta-icon">
                                                            <x-icon width="20px" color="var(--primary-color)" name="{{ $meta->icon }}" />
                                                        </div>
                                                    @endif
                                                    <div class="meta-content">
                                                        <span class="meta-label">{{ $meta->key }}:</span>
                                                        <span class="meta-value">{{ $meta->value }}</span>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <div class="clearfix"></div>

                            <!-- Gallery -->
                            @if (!is_null($post->gallary))
                                <div class="post-gallery">
                                    <h4 class="gallery-title">{{ __('Photo Gallery') }}</h4>
                                    <x-theme.gallary :gallary="$post->gallary->getMedia('gallary')" />
                                </div>
                            @endif

                            <!-- Attachments -->
                            @if (!$post->getMedia('attachments')->isEmpty())
                                <div class="post-attachments">
                                    <h4 class="attachments-title">{{ __('Attachments') }}</h4>
                                    <div class="attachment-list">
                                        @foreach ($post->getMedia('attachments') as $media)
                                            <div class="attachment-item">
                                                <div class="attachment-info">
                                                    <i class="fa fa-file-o attachment-icon"></i>
                                                    <span class="attachment-name">{{ $media->getDownloadFilename() }}</span>
                                                </div>
                                                <a class="download-btn" href="{{ route('downloadAttachment', $media) }}">
                                                    <i class="fa fa-download"></i> {{ __('Download') }}
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Post Footer -->
                        <div class="single-blog-bottom">
                            <!-- Tags -->
                            <ul class="tags">
                                <li><i class="fa fa-tags" aria-hidden="true"></i> {{ __('Tags') }} :</li>
                                @unless ($post->tags->isEmpty())
                                    @foreach ($post->tags as $tag)
                                        @include($skyTheme . '.partial.tag')
                                    @endforeach
                                @endunless
                            </ul>
                            
                            <!-- Share Options -->
                            <div class="event-share-option">
                                <span>{{ __('Share') }}</span>
                                <div class="sharethis-inline-share-buttons"></div>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Contact Form -->
                @if ($post->has_contact_form)
                    <div class="post-contact-form">
                        <x-theme.contact-us :sub-heading="__(
                            'Professionally mesh enterprise wide imperatives without world class paradigms. Dynamically deliver ubiquitous leadership awesome skills.',
                        )" />
                    </div>
                @endif

                <!-- Comments -->
                <div class="com">
                    @if ($settings->comments_enabled)
                        @livewire('comment', ['post' => $post])
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                @include($skyTheme . '.partial.sidebar')
            </div>
        </div>
    </div>
</section>
@push('styles')
<style>
.like-button.liked i,.like-button:hover i{transform:scale(1.15)}.meta-post,.single-date,.tags{list-style:none}:root{--primary-color:#78b843;--primary-hover:#68a336;--secondary-color:#4a6741;--dark-color:#2c3e2e;--light-color:#f9fcf7;--border-color:#dbe9d3;--text-color:#333;--meta-color:#666;--bg-light:#f4f9f0}.header-title{font-size:2.25rem;font-weight:700;text-transform:capitalize}.badge.bg-accent{background-color:var(--primary-color)!important;color:#fff!important;font-weight:500;padding:6px 12px;border-radius:4px}.ProseMirror a,.breadcrumb-item a{color:var(--primary-color);text-decoration:none;transition:color .2s}.ProseMirror a:hover,.breadcrumb-item a:hover{color:var(--primary-hover);text-decoration:underline}.breadcrumb-item.active{color:var(--dark-color)}.single-post-section{padding:30px 0 70px}.post-contact-form,.single-post-content{margin-bottom:40px}.featured-image-container{position:relative;margin-bottom:30px;border-radius:8px;overflow:hidden;box-shadow:0 3px 10px rgba(0,0,0,.1)}.featured-image-container img{width:100%;height:auto;display:block}.event-date-box{position:absolute;top:20px;left:20px;background-color:var(--primary-color);color:#fff;border-radius:6px;overflow:hidden;box-shadow:0 3px 8px rgba(0,0,0,.15);width:80px;height:80px;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center}.blog-content-wrapper,.com{box-shadow:0 3px 15px rgba(0,0,0,.05)}.date-inner{width:100%;height:100%;display:flex;flex-direction:column;justify-content:center}.day{font-size:28px;font-weight:700;line-height:1}.month{font-size:14px;text-transform:uppercase;margin-top:5px}.blog-content-wrapper{background:#fff;border-radius:8px;padding:25px 30px}.meta-box{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;flex-wrap:wrap;gap:15px}.event-author-option{display:flex;align-items:center;gap:12px}.meta-post,.meta-post li{display:flex;align-items:center}.event-author-img{width:42px;height:42px;border-radius:50%;overflow:hidden}.event-author-img img{width:100%;height:100%;object-fit:cover}.event-author-name p{margin:0;color:var(--meta-color)}.event-author-name a,.meta-post li i,.tags li i{color:var(--primary-color)}.event-author-name a{font-weight:600;text-decoration:none;transition:color .2s}.like-button,.like-count,.meta-post li,.meta-value{color:var(--meta-color)}.event-author-name a:hover{color:var(--primary-hover)}.meta-post{padding:0;margin:0;gap:20px}.meta-post li{gap:7px}.like-button,.meta-item{align-items:center;display:flex}.like-button{background:0 0;border:none;gap:5px;padding:0;cursor:pointer;position:relative}.like-button i{color:#888;font-size:18px;transition:.2s}.like-button.liked i{color:#e74c3c}.blog-content{color:var(--text-color)}.ProseMirror h2,.ProseMirror h3,.post-title{color:var(--dark-color)}.post-title{font-size:28px;margin-bottom:20px}.tiptap-editor{font-size:17px;line-height:1.7;margin-bottom:30px}.ProseMirror h2{font-size:26px;margin-top:35px;margin-bottom:20px}.ProseMirror h3{font-size:22px;margin-top:30px;margin-bottom:15px}.ProseMirror p{margin-bottom:20px}.ProseMirror ol,.ProseMirror ul{margin-bottom:25px;padding-left:25px}.ProseMirror li{margin-bottom:10px}.ProseMirror img{max-width:100%;height:auto;border-radius:6px;margin:25px 0}.ProseMirror blockquote{border-left:4px solid var(--primary-color);padding:15px 20px;margin:25px 0;background-color:var(--light-color);font-style:italic;color:var(--secondary-color)}.post-meta-info{background-color:var(--light-color);padding:20px;border-radius:8px;margin:30px 0}.meta-icon,.tags li a{background-color:rgba(120,184,67,.1)}.single-date-option{float:initial!important}.meta-section-title{font-size:20px;color:var(--dark-color);margin-bottom:15px;padding-bottom:10px;border-bottom:1px solid var(--border-color)}.single-date{padding:0;margin:0}.meta-item{gap:12px;margin-bottom:12px;padding-bottom:12px;border-bottom:1px dashed var(--border-color)}.meta-item:last-child{margin-bottom:0;padding-bottom:0;border-bottom:none}.meta-icon{min-width:40px;width:40px;height:40px;display:flex;align-items:center;justify-content:center;border-radius:6px}.meta-content{flex:1}.meta-label{display:inline-block;font-weight:600;color:var(--dark-color);margin-right:5px}.post-attachments,.post-gallery{margin:30px 0}.attachments-title,.gallery-title{font-size:20px;color:var(--dark-color);margin-bottom:20px;padding-bottom:10px;border-bottom:1px solid var(--border-color)}.attachment-list{background-color:var(--light-color);border-radius:8px;overflow:hidden}.download-btn,.tags li a:hover{background-color:var(--primary-color)}.attachment-item{display:flex;justify-content:space-between;align-items:center;padding:12px 15px;border-bottom:1px solid rgba(0,0,0,.05);transition:background-color .2s}.attachment-item:last-child{border-bottom:none}.attachment-item:hover{background-color:rgba(120,184,67,.05)}.attachment-info{display:flex;align-items:center;gap:10px}.attachment-icon{color:var(--primary-color);font-size:18px}.download-btn,.tags li a{border-radius:4px;text-decoration:none;font-size:14px;transition:.2s}.attachment-name{font-weight:500;color:var(--text-color)}.download-btn{display:inline-flex;align-items:center;gap:8px;color:#fff;padding:8px 15px;font-weight:500}.download-btn:hover{background-color:var(--primary-hover);color:#fff;text-decoration:none}.single-blog-bottom{margin-top:30px;padding-top:20px;border-top:1px solid var(--border-color)}.tags{display:flex;flex-wrap:wrap;gap:10px;align-items:center;margin-bottom:20px;padding:0}.tags li{display:flex;align-items:center;gap:5px}.tags li a{display:inline-block;padding:5px 10px;color:var(--primary-color)}.tags li a:hover{color:#fff}.event-share-option{display:flex;align-items:center;gap:15px;padding-top:15px;border-top:1px dashed var(--border-color)}.event-share-option span{font-weight:600;color:var(--dark-color)}.com{background:#fff;border-radius:8px;padding:25px}[dir=rtl] .event-date-box{left:auto;right:20px}[dir=rtl] .ProseMirror ol,[dir=rtl] .ProseMirror ul{padding-left:0;padding-right:25px}[dir=rtl] .ProseMirror blockquote{border-left:none;border-right:4px solid var(--primary-color)}[dir=rtl] .meta-label{margin-right:0;margin-left:5px}@media (max-width:991px){.header-title{font-size:1.75rem}.blog-content-wrapper{padding:20px}.meta-box{flex-direction:column;align-items:flex-start}.post-title{font-size:24px}.tiptap-editor{font-size:16px}}@media (max-width:767px){.event-date-box{width:70px;height:70px}.day{font-size:24px}.month{font-size:12px}.meta-post{flex-wrap:wrap;gap:15px}.attachment-item{flex-direction:column;align-items:flex-start;gap:12px}.tags{flex-direction:column;align-items:flex-start}.event-share-option{flex-direction:column;align-items:flex-start;gap:15px}}
</style>

    
@endpush