<?php

namespace App\Models;

use App\Models\Blog\Faq;
use App\Models\Blog\Library;
use App\Models\Blog\Navigation;
use App\Models\Blog\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Builder;

class Panel extends Model
{
    use HasFactory;

    protected $fillable = ['panel_id', 'panel_name'];

    // this modal will have many resurcable

    public function posts($type = null): MorphToMany
    {
        return $this
            ->morphedByMany(
                Post::class,
                'resourcables',
            )->where('post_type'  , $type);
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

    public function gallaries(): MorphToMany
    {
        return $this->morphedByMany(
            Gallary::class,
            'resourcables'
        );
    }

    /**
     * @deprecated type issue now method name is cources
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function courcsess(): MorphToMany
    {
        return $this->cources();
    }

    public function cources(): MorphToMany {
        return $this->morphedByMany(
            Cource::class,
            'resourcables'
        );
    }

    public function initiatives(): MorphToMany
    {
        return $this->morphedByMany(
            Initiative::class,
            'resourcables'
        );
    }
    public function supporters(): MorphToMany
    {
        return $this->morphedByMany(
            Supporter::class,
            'resourcables'
        );
    }
    public static function findByName(string $name)
    {
        return static::query()
            ->where('panel_name', $name)
            ->first();
    }

    public static function findById(string $id) {
        return static::query()
            ->where('panel_id', $id)
            ->first();
    }

    public function scopePanelByName(Builder $query,string $name) : Builder {
        return $query->where('panel_id' , $name) ;
    }




}

// class_alias('App\Models\Panel', 'PanelModel');
