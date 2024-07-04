<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;
use App\Models\Post;
class PostMeta extends Model
{
    use HasFactory , HasTranslations;

    protected $table = 'post_meta';
    protected $fillable = ['post_id', 'key', 'value', 'icon'];

    protected $translatable = ['key', 'value'];
    // relation PostMeta belongs to one post

    public function post() : BelongsTo {
        return $this->belongsTo(Post::class);
    }
}
