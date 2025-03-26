@props(['posts', 'subHeading'])
@use(Illuminate\Support\Str)

<!-- Enhanced News Section -->
<section class="news-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">{{ __('News') }}</h2>
            <p class="section-subtitle">{{ $subHeading }}</p>
        </div>
        
        <div class="row news-grid">
            @foreach ($posts as $post)
                <div class="col-12 col-sm-6 col-lg-4 mb-5">
                    <div class="news-card">
                        <div class="news-card-inner">
                            <!-- Image Area -->
                            <div class="news-image-container">
                                <a href="{{ route('post', $post->slug) }}" class="news-image-link">
                                    <img src="{{ $post->image() }}" alt="{{ $post->title }}" class="news-image" />
                                    <div class="image-overlay">
                                        <span class="read-more-btn">{{ __('Read Article') }} <i class="fa fa-arrow-right"></i></span>
                                    </div>
                                </a>
                                
                                <!-- Like Button -->
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
                            <div class="news-content">
                                <!-- Fixed height title container -->
                                <div class="title-container">
                                    <h3 class="news-title">
                                        <a href="{{ route('post', $post->slug) }}" class="title-link">
                                            {!! $post->title !!}
                                        </a>
                                    </h3>
                                </div>
                                
                                <!-- Date and Likes -->
                                <div class="meta-box">
                                    <ul class="meta-list">
                                        <li class="meta-item date-item">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <span>{{ optional($post->published_at)->format('M d, Y') ?? '' }}</span>
                                        </li>
                                        @if ($post->author)
                                        <li class="meta-item author-item">
                                            <i class="fa fa-user-o" aria-hidden="true"></i>
                                            <span>{{ $post->author->name }}</span>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="view-more-container">
            <a href="{{ route('blogs') }}" class="view-more-btn">
                {{ __('More News') }}
                <i class="fa fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<style>
/* Section Styling */
.news-section {
    padding: 60px 0;
    background-color: var(--body-bg, #f4f9f0);
}

.section-header {
    text-align: center;
    margin-bottom: 40px;
}

.section-title {
    color: var(--dark-color, #2c3e2e);
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 15px;
    position: relative;
    display: inline-block;
}

.section-title:after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    width: 80px;
    height: 3px;
    background: var(--primary-color, #78b843);
    transform: translateX(-50%);
}

.section-subtitle {
    color: var(--secondary-color, #4a6741);
    font-size: 16px;
    max-width: 700px;
    margin: 0 auto;
}

/* Grid Layout */
.news-grid {
    margin-bottom: 40px;
}

/* Card Styling */
.news-card {
    margin-bottom: 30px;
    height: 100%; /* Full height */
}

.news-card-inner {
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 3px 10px rgba(120, 184, 67, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%; /* Full height */
    display: flex;
    flex-direction: column;
}

.news-card-inner:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(120, 184, 67, 0.15);
}

/* Image Styling */
.news-image-container {
    position: relative;
    overflow: hidden;
    aspect-ratio: 16/9;
}

.news-image-container >  a {
    display: block !important;
}

.news-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.news-image-link:hover .news-image {
    transform: scale(1.05);
}

/* Overlay */
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

.news-image-link:hover .image-overlay {
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
    background: var(--primary-color, #78b843);
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

/* Content Styling */
.news-content {
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex-grow: 1; /* Allow content to fill available space */
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Push meta to bottom */
}

/* Important: Fixed height title container */
.title-container {
    height: 76px; /* Fixed height for title - adjust as needed */
    margin-bottom: 15px;
    overflow: hidden;
}

.news-title {
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

.title-link {
    color: var(--dark-color, #2c3e2e);
    text-decoration: none;
    transition: color 0.2s ease;
}

.title-link:hover {
    color: var(--primary-color, #78b843);
}

/* Meta Information */
.meta-box {
    margin-top: auto; /* Push to bottom */
    border-top: 1px solid var(--border-color, #dbe9d3);
    padding-top: 15px;
}

.meta-list {
    padding: 0;
    margin: 0;
    list-style: none;
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
    color: var(--secondary-color, #4a6741);
    font-size: 13px;
}

/* View More Button */
.view-more-container {
    text-align: center;
    margin-top: 20px;
}

.view-more-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background-color: var(--primary-color, #78b843);
    color: white;
    padding: 12px 30px;
    border-radius: 50px;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 8px rgba(120, 184, 67, 0.2);
}

.view-more-btn:hover {
    background-color: var(--primary-hover, #68a336);
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(120, 184, 67, 0.25);
    color: white;
    text-decoration: none;
}

.view-more-btn:active {
    transform: translateY(0);
}

/* RTL Support */
[dir="rtl"] .like-button-wrapper {
    right: auto;
    left: 15px;
}

[dir="rtl"] .read-more-btn i,
[dir="rtl"] .view-more-btn i {
    transform: rotate(180deg);
}

/* Responsive Adjustments */
@media (max-width: 991px) {
    .title-container {
        height: 62px; /* Slightly shorter on tablet */
    }
    
    .news-title {
        font-size: 16px;
        -webkit-line-clamp: 2;
    }
}

@media (max-width: 767px) {
    .news-section {
        padding: 40px 0;
    }
    
    .section-title {
        font-size: 28px;
    }
    
    .meta-list {
        justify-content: space-between;
    }
}
</style>