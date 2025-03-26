<!-- Enhanced Blog Archive Page -->
@use(Illuminate\Pagination\Paginator)
@use(Illuminate\Support\Str)
@php
// Sanitize request URI
$page_title = preg_replace('([?].*)' , '', request()->getRequestUri());
$page_title = str_replace('/' , '' , $page_title);

// Pagination handling
$current_page = empty(request()->query()) || !isset(request()->query()['page']) ? 1 : (int) request()->query()['page'];
$per_page = 6;
$offset = ($current_page * $per_page) - $per_page;
$totalPages = ceil($posts->count()/$per_page);
$paginiator = app(Paginator::class, ['items' => $posts->slice($offset, $per_page), 'perPage' => $per_page]);
$hasMorePages = $totalPages > $current_page;
$paginiator->hasMorePagesWhen($hasMorePages)->withPath(request()->path());
@endphp

<x-slot name="header">
    <div class="page-header">
        <div class="container">
            <h1 class="page-title">
                {{$page_title == 'content' ? __('All News') : __(ucfirst(Str::plural($page_title)))}}
            </h1>
            <div class="breadcrumb-container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('theme.home') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{$page_title == 'content' ? __('All News') : __(ucfirst(Str::plural($page_title)))}}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</x-slot>

<section class="blog-archive-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @unless ($posts->isEmpty())
                    <div class="blog-filter">
                        <div class="filter-count">
                            {{ __('Showing') }} <span>{{ $paginiator->count() }}</span> {{ __('of') }} <span>{{ $posts->count() }}</span> {{ __('posts') }}
                        </div>
                        <!-- Optional: Add filter controls here if needed -->
                    </div>
                    
                    <div class="row blog-grid">
                        @foreach($paginiator->items() as $post)
                            <div class="col-12 col-sm-6 col-lg-4 mb-5">
                                <article class="blog-card">
                                    <div class="blog-card-inner">
                                        <!-- Featured Image with Overlay -->
                                        <div class="blog-image-wrapper">
                                            <a href="{{ route('post', $post->slug) }}" class="blog-image-link">
                                                <img src="{{ $post->image() }}" alt="{{ $post->title }}" class="blog-image" />
                                                <div class="image-overlay">
                                                    <span class="read-more-btn">{{ __('Read Article') }} <i class="fa fa-arrow-right"></i></span>
                                                </div>
                                            </a>
                                            
                                            <!-- Like Button Positioned on Image -->
                                            <div class="like-button-wrapper" 
                                                x-data="{
                                                    likes: @js($post->likes),
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
                                            </div>
                                        </div>
                                        
                                        <!-- Content Area -->
                                        <div class="blog-content">
                                            <!-- Post Title with Fixed Height -->
                                            <div class="title-container">
                                                <h3 class="post-title">
                                                    <a href="{{ route('post', $post->slug) }}">{!! $post->title !!}</a>
                                                </h3>
                                            </div>
                                            
                                            <!-- Author and Date Info -->
                                            <div class="post-meta">
                                                <div class="post-date">
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <span>{{ optional($post->published_at)->format('M d, Y') ?? '' }}</span>
                                                </div>
                                                <div class="post-author">
                                                    <i class="fa fa-user-o" aria-hidden="true"></i>
                                                    <span>{{ $post->author->name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Enhanced Pagination -->
                    <div class="pagination-container">
                        @if($paginiator->hasPages())
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <!-- Previous Page Link -->
                                    @if($paginiator->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="fa fa-angle-double-left"></i></span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $paginiator->previousPageUrl() }}" rel="prev">
                                                <i class="fa fa-angle-double-left"></i>
                                            </a>
                                        </li>
                                    @endif
                                    
                                    <!-- Page Numbers -->
                                    @for($i = 1; $i <= $totalPages; $i++)
                                        @if($i == $current_page)
                                            <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $paginiator->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endif
                                    @endfor
                                    
                                    <!-- Next Page Link -->
                                    @if($paginiator->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $paginiator->nextPageUrl() }}" rel="next">
                                                <i class="fa fa-angle-double-right"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="fa fa-angle-double-right"></i></span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        @endif
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fa fa-newspaper-o"></i>
                        </div>
                        <h3>{{ __('No Posts Found') }}</h3>
                        <p>{{ __('There are no posts available at the moment. Please check back later.') }}</p>
                    </div>
                @endunless
            </div>
        </div>
    </div>
</section>
@push('styles')
    
<style>
/* Page Header Styles */
.page-header {
    background-color: var(--primary-color, #78b843);
    background-image: linear-gradient(135deg, rgba(120, 184, 67, 0.95), rgba(74, 103, 65, 0.9)), 
                      url('/images/pattern-bg.png');
    color: white;
    padding: 50px 0;
    margin-bottom: 50px;
    position: relative;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    text-align: center;
}

.breadcrumb-container {
    display: flex;
    justify-content: center;
}

.breadcrumb {
    background: transparent;
    margin: 0;
    padding: 0;
    display: flex;
    list-style: none;
}

.breadcrumb-item {
    color: rgba(255, 255, 255, 0.8);
}

.breadcrumb-item a {
    color: #fff;
    text-decoration: none;
}

.breadcrumb-item.active {
    color: rgba(255, 255, 255, 0.9);
}

.breadcrumb-item + .breadcrumb-item::before {
    content: "/";
    color: rgba(255, 255, 255, 0.6);
}

/* Blog Archive Section */
.blog-archive-section {
    padding: 30px 0 70px;
    background-color: var(--body-bg, #f4f9f0);
}

/* Blog Filter */
.blog-filter {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 1px solid var(--border-color, #dbe9d3);
}

.filter-count {
    color: var(--secondary-color, #4a6741);
    font-size: 0.95rem;
}

.filter-count span {
    font-weight: 600;
    color: var(--primary-color, #78b843);
}

/* Blog Grid */
.blog-grid {
    margin-bottom: 40px;
}

/* Blog Card Styles */
.blog-card {
    margin-bottom: 30px;
    height: 100%;
}

.blog-card-inner {
    height: 100%;
    background-color: #ffffff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 3px 10px rgba(120, 184, 67, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
}

.blog-card-inner:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(120, 184, 67, 0.15);
}

/* Image Styles */
.blog-image-wrapper {
    position: relative;
    overflow: hidden;
    aspect-ratio: 16/9;
}
.blog-image-wrapper >a {
    display:block;
}
.blog-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.blog-image-link:hover .blog-image {
    transform: scale(1.05);
}

/* Image Overlay */
.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.blog-image-link:hover .image-overlay {
    opacity: 1;
}

.read-more-btn {
    color: #fff;
    background-color: rgba(120, 184, 67, 0.85);
    padding: 8px 16px;
    border-radius: 4px;
    font-size: 14px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 6px;
}

/* Like Button */
.like-button-wrapper {
    position: absolute;
    top: 15px;
    right: 15px;
    z-index: 10;
}

.like-button {
    background: rgba(255, 255, 255, 0.9);
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
    position: relative;
}

.like-button i {
    color: #888;
    font-size: 18px;
    transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.like-button.liked i {
    color: #e74c3c;
}

.like-button:hover i {
    transform: scale(1.15);
}

.like-button:active {
    transform: scale(0.95);
}

.like-count {
    position: absolute;
    bottom: -5px;
    right: -5px;
    background: #78b843;
    color: white;
    border-radius: 10px;
    font-size: 10px;
    min-width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

/* Content Area */
.blog-content {
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

/* Fixed-height title container for consistent card heights */
.title-container {
    height: 76px; /* Fixed height for title */
    margin-bottom: 15px;
    overflow: hidden;
}

.post-title {
    margin: 0;
    font-size: 18px;
    line-height: 1.4;
    font-weight: 600;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}

.post-title a {
    color: var(--dark-color, #2c3e2e);
    text-decoration: none;
    transition: color 0.2s ease;
}

.post-title a:hover {
    color: var(--primary-color, #78b843);
}

.post-meta {
    display: flex;
    justify-content: space-between;
    margin-top: auto;
    padding-top: 15px;
    border-top: 1px solid var(--border-color, #dbe9d3);
    font-size: 13px;
    color: var(--secondary-color, #4a6741);
}

.post-author, .post-date {
    display: flex;
    align-items: center;
    gap: 6px;
}

/* Pagination Styles */
.pagination-container {
    margin-top: 40px;
    display: flex;
    justify-content: center;
}

.pagination {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    border-radius: 50px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(120, 184, 67, 0.15);
}

.page-item {
    margin: 0;
}

.page-link {
    color: var(--secondary-color, #4a6741);
    background-color: #fff;
    border: none;
    min-width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 15px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.page-item.active .page-link {
    background-color: var(--primary-color, #78b843);
    color: white;
}

.page-item:not(.active) .page-link:hover {
    background-color: rgba(120, 184, 67, 0.1);
    color: var(--primary-color, #78b843);
}

.page-item.disabled .page-link {
    color: #ccc;
    cursor: not-allowed;
}

/* Empty State */
.empty-state {
    background: #fff;
    border-radius: 8px;
    padding: 60px 20px;
    text-align: center;
    box-shadow: 0 3px 10px rgba(120, 184, 67, 0.1);
}

.empty-state-icon {
    font-size: 5rem;
    color: var(--primary-color, #78b843);
    opacity: 0.3;
    margin-bottom: 20px;
}

.empty-state h3 {
    font-size: 1.75rem;
    color: var(--dark-color, #2c3e2e);
    margin-bottom: 15px;
}

.empty-state p {
    color: var(--secondary-color, #4a6741);
    max-width: 500px;
    margin: 0 auto;
}

/* RTL Support */
[dir="rtl"] .like-button-wrapper {
    right: auto;
    left: 15px;
}

[dir="rtl"] .read-more-btn i {
    transform: rotate(180deg);
}

/* Responsive Adjustments */
@media (max-width: 991px) {
    .page-title {
        font-size: 2rem;
    }
    
    .title-container {
        height: 62px;
    }
    
    .post-title {
        font-size: 16px;
        -webkit-line-clamp: 2;
    }
}

@media (max-width: 767px) {
    .page-header {
        padding: 30px 0;
    }
    
    .blog-archive-section {
        padding: 20px 0 50px;
    }
    
    .post-meta {
        flex-direction: column;
        gap: 8px;
    }
    
    .pagination .page-link {
        min-width: 35px;
        height: 35px;
        padding: 0 10px;
    }
}
</style>
@endpush
