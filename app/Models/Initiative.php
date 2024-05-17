<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Initiative extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'initiativies';
    protected $fillable = ['title', 'slug', 'type'];
    public function supporters(): BelongsToMany
    {
        return $this->belongsToMany(Supporter::class, 'initiativies_suporters', 'initiative_id', 'supporter_id');
    }

}
