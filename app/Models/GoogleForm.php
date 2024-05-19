<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GoogleForm extends Model
{
    use HasFactory;

    /**
     * Form has many posts we asign form by joing a forign key on postst table for the origign fomr id
     * @var array
     */
   public function posts() : HasMany {
        return $this->hasMany(Post::class);
   }
    protected  $fillable = [
        'name',
        'google_file_id',
        'type',
        'google_mimeType',
        'web_view_link',
        'questions',
        'responder_uri'
    ];
}
