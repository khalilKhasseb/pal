<?php

namespace App\Models\Blog;

use \LaraZeus\Sky\Models\Faq as Model;
use App\Traits\PanelResource;
use Spatie\Tags\HasTags;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
// use App\Models\Blog\Tag;

class Faq extends Model
{
    use HasTags;
    use PanelResource;

    public static function getTagClassName(): string
    {
        return \App\Models\Blog\Tag::class;
    }

    // public function tags(): MorphToMany
    // {
    //     // dd(
    //     //     self::getTagClassName(),
    //     //     $this->getTaggableMorphName(),
    //     //     $this->getTaggableTableName()
    //     // );
    //     return $this
          
    //     ->morphToMany(self::getTagClassName(), 'taggable', 'taggables', null, 'tag_id')
    //     ->orderBy('order_column');
    // }


}
