<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use LaraZeus\Sky\Models\Post as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Scopes\PanelScope;
use App\Models\Scopes\ContentProviderScope;
use App\Models\PostMeta;
use Spatie\Image\Enums\CropPosition;
use Illuminate\Support\Collection;
use Spatie\Image\Enums\Fit;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use \App\Traits\PanelResource;
    protected $casts = [
        'published_at' => 'datetime',
        'sticky_until' => 'datetime',
        'has_thumb' => 'boolean',
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(GoogleForm::class, 'google_form_id', 'id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(config('auth.providers.system_users.database.model', config('auth.providers.system_users.model')), 'user_id', 'id');
    }

    public function scopePan(Builder $builder)
    {
        $builder->whereHas('panels', function ($builder) {
            return $builder->where('panels.id', 2);
        });
    }



    // Post meta relation

    public function post_meta(): HasMany
    {
        return $this->hasMany(PostMeta::class, 'post_id', 'id');
    }
    public function links(): MorphMany
    {
        return $this->morphMany(Links::class, 'linkable');
    }
    // Likes relation
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class, 'post_id', 'id');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commantabel');
    }

    public function get_like_ip(string $ip)
    {
        return $this->likes()->where('ip', $ip)->first();
    }

    public function checkIfHasLikeForThisIp(string $ip)
    {
        return $this->get_like_ip($ip) !== null;
    }

    public function has_likes()
    {

        return $this->likes()->count() > 0;
    }

    public function image($collection = 'posts'): Collection|string|null
    {
        // Check if the thumbnail collection is empty and no custom thumb exists
        if ($this->getMedia('thumbnail')->isEmpty() && !$this->has_thumb) {
            // Try to load the thumb from the specified media collection (default 'posts')
            $media = $this->getMedia($collection)->first();
            if ($media) {
                $thumbPath = parse_url($media->getUrl('thumb-cropped-original'), PHP_URL_PATH);
                $thumbFullPath = base_path('public' . $thumbPath);

                // Check if the cropped thumbnail file exists, fallback if it doesn't
                if (file_exists($thumbFullPath)) {
                    return $media->getUrl('thumb-cropped-original');
                }

                // Fallback to parent image if thumb doesn't exist
                return parent::image();
            }
        }

        // If a custom thumb exists in the 'thumbnail' collection, return its URL
        if ($this->getMedia('thumbnail')->isNotEmpty() && $this->has_thumb) {
            return $this->getMedia('thumbnail')->first()->getUrl('thumb-cropped');
        }

        // Final fallback: return the parent image if no thumbnail or media is available
        return parent::image();
    }

    public function cover() {

        return $this->getFirstMediaUrl('post_cover') ?? null;
    }

    public function coverInfo():HasOne{
        return $this->hasOne(CoverInfo::class);
    }


    public function gallary(): BelongsTo
    {
        return $this->belongsTo(Gallary::class, 'gallary_id', 'id');
    }

    public function registerMediaConversions(\Spatie\MediaLibrary\MediaCollections\Models\Media|null $media = null): void
    {

        $this->addMediaConversion('thumb-cropped')
            ->performOnCollections('thumbnail')
            ->crop(380, 300, CropPosition::Center);

        
        $this->addMediaConversion('thumb-cropped-original')
            ->performOnCollections('posts')
            ->fit(Fit::Fill, 380, 300, false, '#333');

        $this->addMediaConversion('fit-slider')
            ->performOnCollections('posts')
            ->fit(Fit::Fill, 1200, 400, false, '#333');

    }
    public function getContent(): string
    {
        if (is_array($this->content)) {
            $this->content = json_encode($this->content);
        }
        return $this->parseContent(config('zeus-sky.editor')::render($this->content));
    }


    
}
