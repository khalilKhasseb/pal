<?php

return [
    'domain' => null,

    /**
     * set the default path for the blog homepage.
     */
    'prefix' => 'content',

    /**
     * the middleware you want to apply on all the blog routes
     * for example if you want to make your blog for users only, add the middleware 'auth'.
     */
    'middleware' => ['web'],

    /**
     * URI prefix for each content type
     */
    'uri' => [
        'post' => 'post',
        'page' => 'page',
        'library' => 'library',
        'faq' => 'faq',
    ],


    'post_types' => [
        'activity',
        'administration',
        'event',
        'hall',
        'partner',
        'product',
        'service'
    ],

    'tags_type' => [
        'activity',
        'administration',
        'event',
        'hall',
        'partner',
        'product',
        'service',
        'gallary',
        'expert'
    ],

    /**
     * you can overwrite any model and use your own
     * you can also configure the model per panel in your panel provider using:
     * ->skyModels([ ... ])
     */
    'models' => [
        'Faq' => App\Models\Blog\Faq::class,
        'Post' => App\Models\Post::class,
        'PostStatus' => \LaraZeus\Sky\Models\PostStatus::class,
        'Tag' => App\Models\Blog\Tag::class,
        'Library' => App\Models\Blog\Library::class,
        'Navigation' => App\Models\Blog\Navigation::class,
    ],

    'parsers' => [
        \LaraZeus\Sky\Classes\BoltParser::class,
    ],

    'recentPostsLimit' => 6,

    'searchResultHighlightCssClass' => 'highlight',

    'skipHighlightingTerms' => ['iframe'], 

    'defaultFeaturedImage' => config('app.asset_url') . '/images/blog/logo_thumb.png',

    /**
     * the default editor for pages and posts, Available:
     * \LaraZeus\Sky\Editors\TipTapEditor::class,
     * \LaraZeus\Sky\Editors\TinyEditor::class,
     * \LaraZeus\Sky\Editors\MarkdownEditor::class,
     * \LaraZeus\Sky\Editors\RichEditor::class,
     */
    'editor' => \LaraZeus\Sky\Editors\TipTapEditor::class,
];
