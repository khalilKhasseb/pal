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

        // $db = env('DB_DATABASE');

        // $popularTags =
        //     DB::select('SELECT taggables.tag_id ,tags.name ,tags.slug,tags.type,count(*) as count FROM taggables
        // inner join tags on taggables.tag_id = tags.id and tags.type != "library"
        //  group by taggables.tag_id,tags.name');

        // $popularTags = collect($popularTags)->map(function ($tag) {
        //     $name = json_decode($tag->name, true);
        //     $slug = json_decode($tag->slug, true);
        //     $local = app()->getLocale();
        //     // dd($name[$local]);
        //     $local = app()->getLocale();
        //     $opsiteLocal = $local === 'en' ? 'ar' : $local;

        //     $tag->name = $name[
        //         array_key_exists($local, $name)
        //         ? $local
        //         : $opsiteLocal
        //     ];
        //     $tag->slug = $slug[
        //         array_key_exists($local, $slug)
        //         ? $local
        //         : $opsiteLocal
        //     ];

        //     return $tag;
        // });
        // $local = app()->getLocale();

        // dd(\App\Models\Panel::first()->tags);
        // $tagsP = \LaraZeus\Sky\Models\Tag::select([
        //     "tags.name->$local as _name",
        //     "tags.slug->$local as _slug",
        //     'tags.type',
        //     \Illuminate\Support\Facades\DB::raw('count(DISTINCT posts.id) as post_count')
        // ])
        //     ->join('resourcables', 'resourcables.id', '=', 'tags.id') // Correcting the join condition
        //     ->join('taggables', 'taggables.tag_id', '=', 'tags.id') // Ensure taggables is referenced correctly
        //     ->join('posts', 'posts.id', '=', 'taggables.taggable_id')
        //     ->where('resourcables.resourcables_type','like' ,'%Tag%')
        //     ->where('resourcables.panel_id', $panelId)
        //     ->where('taggables.taggable_type', 'like', "%Post%")
        //     ->groupBy('tags.name', 'tags.slug' , 'tags.type')
        //     ->get();
        $panelId = \App\Classes\ContentProvider::getActivePanelID();


        $tags = \LaraZeus\Sky\Models\Tag::select('tags.*')
            ->join('resourcables', function ($join) {
                $join->on('resourcables.resourcables_id', '=', 'tags.id')
                    ->where('resourcables.resourcables_type', 'like', '%Tag%');
            })
            ->where('resourcables.panel_id', $panelId)
            ->whereNotIn('tags.type', ['faq', 'library'])
            ->get();

        
        $view
            ->with('categories', $categories)
            ->with('recent', $recent)
            ->with('pages', $pages)
            ->with('papular_tags', $tags);
    }
}
