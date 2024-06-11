<?php

namespace Database\Seeders;

use App\Classes\CSVParser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\PostMeta;
use Exception;
use Spatie\SimpleExcel\SimpleExcelReader;

class AdministrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //admin
        $local = app()->getLocale();
        $rows = SimpleExcelReader::create('imports/dirctors.csv')->getRows();

        $rows->each(function ($row) use ($local) {
            // create post memeber

            $post_meta_keys = collect(array_filter(array_keys($row), fn ($key) => str_contains($key, 'post_meta')));

            $post = Post::create([
                'title' => $row['title_' . $local],
                'slug' => str($row['title_' . $local])->slug(),
                'description' => fake(app()->getLocale())->sentence(),
                'post_type' => 'administration',
                'content' => $row['content-' . $local],
                'user_id' => 1,
                'featured_image' => null,
                'published_at' => now(),
            ]);

            // // setTranlsation for post

            $post->setTranslation('title', 'en', $row['title_en'])
                ->setTranslation('content', 'en', $row['content-en'])
                ->save();

            // attach post meta  post_meta:key
            // get keys of post meta
            // $post_meta_keys = array_filter($row , fn($key) => str_contains($key , 'post_meta')) ;

            // create Post meta

            $post_meta_keys->each(function ($key) use ($local, $row, $post) {
                // create only for local after that set tranlsation for created meta
                // $trimedKey = substr($key, strlen('post_meta') + 1);

                if (str_contains($key, $local)) {
                    $trimedKey = substr($key, strlen('post_meta') + 1);
                    $post_meta = PostMeta::create([
                        'key' => $trimedKey,
                        'value' => $row[$key]
                    ]);

                    // set Translation for post meta
                    $trimedKey = str_replace($local, 'en', $trimedKey);
                    $post_meta->setTranslation('key', 'en', $trimedKey)
                        ->setTranslation('value', 'en', $row['post_meta:' . $trimedKey])
                        ->save();

                    $post->post_meta()->save($post_meta);
                } elseif (!str_contains($key, $local) && !str_contains($key, 'en')) {
                    $trimedKey = substr($key, strlen('post_meta') + 1);
                    $post_meta = PostMeta::create([
                        'key' => $trimedKey,
                        'value' => $row[$key]
                    ]);

                    $post->post_meta()->save($post_meta);
                }
            });

            // AttachPanel
            $post->panels()->attach(1);

            // attach media

            try {
                $post->addMediaFromUrl($row['img'])->toMediaCollection('posts');
            } catch (Exception $exception) {
            }
        });

        return;
        // $adminsitartions = CSVParser::parse(base_path('imports/administrations.csv'));
        // $meta = CSVParser::parse(base_path('imports/administrations-post_meta.csv'));
        // for ($i = 0; $i < count($adminsitartions); $i++) {
        //     $adminsitartions[$i]['post_meta'] = $meta[$i];
        // }

        // foreach ($adminsitartions as $ad) {
        //     $post = Post::create([
        //         'title' => $ad['title'],
        //         'slug' => fake()->slug(2),
        //         'description' => fake(app()->getLocale())->sentence(),
        //         'post_type' => $ad['post_type'],
        //         'content' => $ad['content'],
        //         'user_id' => 1,
        //         'featured_image' => null,
        //         'published_at' => now(),
        //     ]);
        //     $post->panels()->attach($ad['panel']);

        //     foreach ($ad['post_meta'] as $key => $value) {
        //         $post->post_meta()->save(PostMeta::create([
        //             'key' => $key,
        //             'value' => $value
        //         ]));
        //     }

        //     try {
        //         $post->addMediaFromUrl($ad['featured_img'])->toMediaCollection('posts');
        //     } catch (Exception $exception) {
        //     }
        // }
    }
}
