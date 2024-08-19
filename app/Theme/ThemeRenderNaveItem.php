<?php

namespace App\Theme;


use LaraZeus\Sky\SkyPlugin;
use App\Models\Blog\Tag;

class ThemeRenderNaveItem
{



    public static function render(array $item, $sommod = true, string $class = '')
    {
        $local = app()->getLocale();

        $label = $item['label_' . $local] === null || empty($item['label_' . $local])
            ? ($local === 'ar' ? $item['label_en'] : $item['label_ar'])
            : $item['label_' . $local];

        $color = '';
        if ($item['type'] === 'category') {
            $category = SkyPlugin::get()->getModel('Tag')::whereIn('type', Tag::getTypes())->find($item['data']['category_id']) ?? '';
            $activeClass = (request()->routeIs('page', 'category')) ? $color : 'border-transparent';
            return '<a class="' . $class . ' ' . $activeClass . '"
            target="' . ($item['data']['target'] ?? '_self') . '"
            href="' . route('tags', [
                'slug' => $category->slug,
                'type' => $category->type
            ]) . '"
        >' .
                $label .
                '</a>';
        }
        if ($item['type'] === 'page-link' || $item['type'] === 'page_link') {
            $page = SkyPlugin::get()->getModel('Post')::page()->whereDate('published_at', '<=', now())->find($item['data']['page_id']) ?? '';

            $activeClass = (request()->routeIs('page')) ? $color : 'border-transparent';

            return '<a class="' . $class . ' ' . $activeClass . '"
                    target="' . ($item['data']['target'] ?? '_self') . '"
                    href="' . route('page', $page) . '"
                >' .
                $label .
                '</a>';
        } elseif ($item['type'] === 'post-link' || $item['type'] === 'post_link') {
            $post = SkyPlugin::get()->getModel('Post')::find($item['data']['post_id']) ?? '';
            $activeClass = (request()->routeIs('post')) ? $color : 'border-transparent';

            return '<a class="' . $class . ' ' . $activeClass . '"
                    target="' . ($item['data']['target'] ?? '_self') . '"
                    href="' . route('post', $post) . '"
                >' .
                $label .
                '</a>';
        } elseif ($item['type'] === 'library-link' || $item['type'] === 'library_link') {
            $tag = SkyPlugin::get()->getModel('Tag')::find($item['data']['library_id']) ?? '';
            $activeClass = (str(request()->url())->contains($tag->library->first()->slug)) ? $color : 'border-transparent';

            return '<a class="' . $class . ' ' . $activeClass . '"
                    target="' . ($item['data']['target'] ?? '_self') . '"
                    href="' . route('library.tag', $tag->slug) . '"
                >' .
                $label .
                '</a>';
        } elseif ($item['type'] === 'collection') {
            return '<a class="' . $class . '"
                    target="' . ($item['data']['target'] ?? '_self') . '"
                    href="' . route($item['data']['collection']) . '"
                >' .
                $label .
                '</a>';
        } elseif ($item['type'] === 'sommod-routes') {

            return '<a class="' . $class . '"
                    target="' . ($item['data']['target'] ?? '_self') . '"
                    href="' . route($item['data']['sommod_routes']) . '"
                >' .
                $label .
                '</a>';
        } else {
            return '<a class="' . $class . '"
                    target="' . ($item['data']['target'] ?? '_self') . '"
                    href="' . $item['data']['url'] . '"
                >' .
                $label .
                '</a>';
        }
    }
}
