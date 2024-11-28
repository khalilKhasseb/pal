<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Governorate extends Model
{
    use HasFactory , HasTranslations;
    protected $fillable = ['name', 'slug'];

    public $translatable = ['name'];

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    // public function country(): BelongsTo
    // {
    //     return $this->belongsTo(Country::class);
    // }

    public static function findBySlug(string $slug): Model
    {
        return static::where('slug', '=', $slug)->first();
    }

}
