<?php

namespace App\View\Creators;

use Illuminate\View\View;
use LaraZeus\Sky\SkyPlugin;
use Illuminate\Support\Facades\DB;

class BlogCreator
{

    public function compose(View $view): void
    {
        $search = request('search');
        $category = request('category');
        $categories = SkyPlugin::get()->getModel('Tag')::getWithType('category');
        $recent = config('zeus-sky.models.Post')::query()
            ->posts()
            ->published()
            ->whereDate('published_at', '<=', now())
            ->with(['tags', 'author', 'media'])
            ->limit(config('zeus-sky.recentPostsLimit'))
            ->orderBy('published_at', 'desc')
            ->get();

        $pages = config('zeus-sky.models.Post')::query()
            ->page()
            ->whereDate('published_at', '<=', now())
            ->search($search)
            ->with(['tags', 'author', 'media'])
            ->forCategory($category)
            ->orderBy('published_at', 'desc')
            ->whereNull('parent_id')
            ->get();

        $db = env('DB_DATABASE');

        $popularTags =
            DB::select('SELECT taggables.tag_id ,tags.name ,tags.slug,tags.type,count(*) as count FROM taggables
        inner join tags on taggables.tag_id = tags.id and tags.type != "library"
         group by taggables.tag_id,tags.name');

        // dd($popularTags);
        $popularTags = collect($popularTags)->map(function ($tag) {
            $name = json_decode($tag->name, true);
            $slug = json_decode($tag->slug, true);
            $local = app()->getLocale();
            // dd($name[$local]);
            $local = app()->getLocale();
            $opsiteLocal = $local === 'en' ? 'ar' : $local;

            $tag->name = $name[
                array_key_exists($local, $name)
                ? $local
                : $opsiteLocal
            ];
            $tag->slug = $slug[
                array_key_exists($local, $slug)
                ? $local
                : $opsiteLocal
            ];

            return $tag;
        });

        $view
            ->with('categories', $categories)
            ->with('recent', $recent)
            ->with('pages', $pages)
            ->with('papular_tags', $popularTags);
    }
}
