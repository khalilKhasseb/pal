<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
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

    protected $casts = [
        'published_at' => 'datetime',
        'sticky_until' => 'datetime',
        'has_thumb' => 'boolean',
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(GoogleForm::class, 'google_form_id', 'id');
    }
    // protected static function booted(): void
    // {   

    //     $content_provider = json_decode(Storage::get('content_provider.json'));


    //     if ($content_provider->source === 'admin') {
    //         static::withoutGlobalScope(ContentProviderScope::class);
    //         static::addGlobalScope(PanelScope::class);
    //     } elseif ($content_provider->source === 'front') {
    //         static::withoutGlobalScope(PanelScope::class);
    //         static::addGlobalScope(ContentProviderScope::class);
    //     }
    // }
    public function author(): BelongsTo
    {
        return $this->belongsTo(config('auth.providers.system_users.database.model', config('auth.providers.system_users.model')), 'user_id', 'id');
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

    public function image($collection = 'posts'): Collection | string | null
    {
        $thumbnail = null;
        #check for event thubmnail media collection
        if ($this->getMedia('thumbnail')->isEmpty() && !$this->has_thumb) {
            #which means we have to load thumb from origin image conversions
            if (!$this->getMedia($collection)->isEmpty()) {

                $thumb_url = $this->getMedia($collection)[0]->getUrl('thumb-cropped-original');


                $thumbnail = $thumb_url;

                return $thumbnail;
            } else {
                $thumbnail = parent::image();
            }
        } elseif (!$this->getMedia('thumbnail')->isEmpty() && $this->has_thumb) {
            #load thumb from thumbnail collection conerstion

            $thumb_url = $this->getMedia('thumbnail')[0]->getUrl('thumb-cropped');
            $thumbnail = $thumb_url;
        } else {

            $thumbnail = parent::image();
        }


        return $thumbnail;
    }

    public function panels(): MorphToMany
    {
        return $this->morphToMany(
            Panel::class,
            'resourcables'
        );
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

        // $this->addMediaConversion('thumb-cropped-original')
        //     ->performOnCollections('posts')
        //     ->crop(380, 300, CropPosition::Center);
        $this->addMediaConversion('thumb-cropped-original')
            ->performOnCollections('posts')
            ->fit(Fit::Fill, 380, 300, false, '#333');
    }
}
