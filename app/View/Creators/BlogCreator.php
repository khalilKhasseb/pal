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

        $popularTags =
        DB::select('SELECT taggables.tag_id ,tags.name ,tags.slug,tags.type,count(*) FROM palgpc.taggables
        inner join tags on taggables.tag_id = tags.id
         group by taggables.tag_id,tags.name');

        $popularTags = collect($popularTags)->map(function ($tag) {

            $tag->name = json_decode($tag->name);
            $tag->slug = json_decode($tag->slug);

            // dd($tag->name->en);
            $tag->name = $tag->name->{app()->getLocale()} ?? $tag->name->en;
            $tag->slug = $tag->slug->{app()->getLocale()} ?? $tag->slug->en;
            return $tag;
        });



        $view
            ->with('categories', $categories)
            ->with('recent', $recent)
            ->with('pages', $pages)
            ->with('papular_tags', $popularTags);
    }
}
