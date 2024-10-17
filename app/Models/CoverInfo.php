<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CoverInfo extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;

    protected $fillable = ['title','post_id', 'source', 'description'];
    protected $translatable = ['description' , 'title'];

    public function post():BelongsTo{
        return $this->belongsTo(Post::class);
    }
 
    public function cover(){
        return $this->getFirstMediaUrl('cover');
    }
}
