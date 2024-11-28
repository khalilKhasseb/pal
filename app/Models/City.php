<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['name', 'slug', 'governorate_id', 'contry_id'];

    public $translatable = ['name'];

    // A city has many students
    public function experts()
    {
        return $this->hasMany(Expert::class);
    }

    // A city has many parents
    public function governorate()
    {
        return $this->hasMany(Governorate::class);
    }

    // A city has many regions
    // public function governorate(): BelongsTo
    // {
    //     return $this->belongsTo(Governorate::class);
    // }

    // public function country(): BelongsTo
    // {
    //     return $this->belongsTo(Country::class);
    // }
}
