<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use LaraZeus\Sky\Models\Post as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Scopes\PanelScope;

class Post extends Model
{


    protected static function booted(): void
    {
        static::addGlobalScope(new PanelScope);
    }
    public function author(): BelongsTo
    {
        return $this->belongsTo(config('auth.providers.system_users.database.model', config('auth.providers.system_users.model')), 'user_id', 'id');
    }


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

    public function panels(): MorphToMany
    {
        return $this->morphToMany(
            Panel::class,
            'resourcables'
        );
    }
}
