<?php

namespace App\Theme;


use LaraZeus\Sky\SkyPlugin;
use App\Models\Blog\Tag;

class ThemeRenderNaveItem
{



    public static function render(array $item, bool $isSommod = true, string $cssClass = ''): string
{
    $locale = app()->getLocale();

    $label = $item['label_' . $locale] ?? ($locale === 'ar' ? $item['label_en'] : $item['label_ar']);

    $activeColor = '';
    $activeClass = 'border-transparent';

    switch ($item['type']) {
        case 'category':
            $category = SkyPlugin::get()->getModel('Tag')::whereIn('type', Tag::getTypes())->find($item['data']['category_id']);
            if ($category) {
                $activeClass = request()->routeIs(['page', 'category']) ? $activeColor : $activeClass;
                return self::generateLink($cssClass, $activeClass, $item['data']['target'] ?? '_self', route('tags', ['slug' => $category->slug, 'type' => $category->type]), $label);
            }
            break;

       
        case 'page_link':
            $page = SkyPlugin::get()->getModel('Post')::page()->whereDate('published_at', '<=', now())->find($item['data']['page_id']);
            if ($page) {
                $activeClass = request()->routeIs('page') ? $activeColor : $activeClass;
                return self::generateLink($cssClass, $activeClass, $item['data']['target'] ?? '_self' , route('page', $page), $label);
            }
            break;

        case 'post_link':
            $post = SkyPlugin::get()->getModel('Post')::find($item['data']['post_id']);
            if ($post) {
                $activeClass = request()->routeIs('post') ? $activeColor : $activeClass;
                return self::generateLink($cssClass, $activeClass, $item['data']['target'] ?? '_self', route('post', $post), $label);
            }
            break;

       
        case 'library_link':
            $tag = SkyPlugin::get()->getModel('Tag')::find($item['data']['library_id']);
            if ($tag) {
                $activeClass = str(request()->url())->contains($tag->library->first()->slug) ? $activeColor : $activeClass;
                return self::generateLink($cssClass, $activeClass, $item['data']['target'] ?? '_self', route('library.tag', $tag->slug), $label);
            }
            break;

        case 'collection':
            return self::generateLink($cssClass, '', $item['data']['target'] ?? '_self', route($item['data']['collection']), $label);

        case 'sommod-routes':
            return self::generateLink($cssClass, '', $item['data']['target'] ?? '_self', route($item['data']['sommod_routes']), $label);

        default:
            return self::generateLink($cssClass, '', $item['data']['target'] ?? '_self', $item['data']['url'], $label);
    }

    return '';
}

private static function generateLink(string $cssClass, string $activeClass, ?string $target, string $url, string $label): string
{
    
    return sprintf(
        '<a class="%s %s" target="%s" href="%s">%s</a>',
        $cssClass,
        $activeClass,
        $target ?? '_self',
        $url,
        $label
    );
}
}
