<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SupportedProjectType extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['name'];
    public $translatable = ['name'];

    public function supporters(): BelongsToMany
    {
        return $this->belongsToMany(Supporter::class, 'supporters_supported_projects_types', 'supported_project_type_id', 'supporter_id');
    }
    public static function findFromString(string $name, string $locale = null)
    {
        $locale = $locale ?? static::getLocale();

        return static::query()
            ->where("name->{$locale}", $name)
            ->get();
    }

    public static function getLocale()
    {
        return app()->getLocale();
    }

}
