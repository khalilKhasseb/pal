<?php

namespace App\Models;

use App\Models\Blog\Faq;
use App\Models\Blog\Library;
use App\Models\Blog\Navigation;
use App\Models\Blog\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Panel extends Model
{
    use HasFactory;

    protected $fillable = ['panel_id', 'panel_name'];

    // this modal will have many resurcable

    public function posts(): MorphToMany
    {

        return $this
            ->morphedByMany(
                Post::class,
                'resourcables',
            );
        /**
         * This panel has many resource get all resource for a given type
         * Return all resource for this panel
         */
    }

    public function libraryes(): MorphToMany
    {
        return $this->morphedByMany(
            Library::class,
            'resourcables'
        );
    }

    public function faqs(): MorphToMany
    {
        return $this->morphedByMany(
            Faq::class,
            'resourcables'
        );
    }

    public function navigations(): MorphToMany
    {
        return $this->morphedByMany(
            Navigation::class,
            'resourcables'
        );
    }

    public function tags(): MorphToMany
    {
        return $this->morphedByMany(
            Tag::class,
            'resourcables'
        );
    }
    public static function findByName(string $name)
    {
        return static::query()
            ->where('panel_name', $name)
            ->first();
    }
}

class_alias('App\Models\Panel', 'PanelModel');
