<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use LaraZeus\Sky\Models\Post as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{

    // protected $fillable = [
    //     'title',
    //     'slug',
    //     'description',
    //     'post_type',
    //     'content',
    //     'user_id',
    //     'parent_id',
    //     'featured_image',
    //     'published_at',
    //     'sticky_until',
    //     'password',
    //     'ordering',
    //     'status',
    //     'like_id'
    // ];


    public function author(): BelongsTo
    {
        return $this->belongsTo(config('auth.providers.system_users.database.model', config('auth.providers.system_users.model')), 'user_id', 'id');
    }


    public function likes(): HasMany
    {
        return $this->hasMany(Like::class, 'post_id', 'id');
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
}
