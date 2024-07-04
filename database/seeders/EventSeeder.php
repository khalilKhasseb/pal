<?php

namespace Database\Seeders;

use App\Classes\CSVParser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\PostMeta;
use Spatie\SimpleExcel\SimpleExcelReader;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // getRows
        $local = app()->getLocale();
        $transLocal = $local === 'ar'  ? 'en' : $local;
        $rows = SimpleExcelReader::create('imports/events.csv')->getRows();

        // map throw each row to inser entites

        $rows->each(function ($row) use ($local, $transLocal) {
            $post_meta_keys = collect(array_filter(array_keys($row), fn ($key) => str_contains($key, 'post_meta')));

            DB::transaction(function () use ($row, $local, $transLocal, $post_meta_keys) {

                // create event
                $post = Post::create([
                    'title' => $row['title_' . $local],
                    'slug' => str($row['title_' . $local])->slug(2),
                    'description' => fake($local)->sentence(),
                    'post_type' => 'event',
                    'content' => $row['content_' . $local],
                    'user_id' => 1,
                    'featured_image' => null,
                    'published_at' => now(),
                ]);

                // setTranslation for evnett

                array_map(function ($attr) use ($transLocal, $row, $post) {
                    if (array_key_exists($attr . "_" . $transLocal, $row)) {
                        $post->setTranslation($attr, $transLocal, $row[$attr . "_$transLocal"])->save();
                    }
                }, $post->getTranslatableAttributes());

                // setPost Meta for event
                $post_meta_keys->each(function ($key) use ($local, $transLocal, $row, $post) {
                    // create only for local after that set tranlsation for created meta
                    // $trimedKey = substr($key, strlen('post_meta') + 1);

                    // first substr key
                    // $sbKey = substr($key ,strlen($key) + 1) ;

                    // cehck if string containe local at last of it

                    // dd($key ,$transLocal, str_contains($key, $local) ,str_contains($key, "_".$transLocal),!str_contains($key, $local),str_contains($key, $local) === false && str_contains($key, $transLocal) === false);
                    if (str_contains($key, $local)) {
                        $trimedKey = substr($key, strlen('post_meta') + 1);
                        $post_meta = PostMeta::create([
                            'key' => $trimedKey,
                            'value' => $row[$key]
                        ]);

                        // set Translation for post meta
                        $trimedKey = str_replace($local, $transLocal, $trimedKey);
                        $post_meta->setTranslation('key', $transLocal, $trimedKey)
                            ->setTranslation('value', $transLocal, $row['post_meta:' . $trimedKey])
                            ->save();

                        $post->post_meta()->save($post_meta);
                    } elseif (!str_contains($key, "_".$local) && !str_contains($key, "_".$transLocal)) {
                        $trimedKey = substr($key, strlen('post_meta') + 1);
                        $post_meta = PostMeta::create([
                            'key' => $trimedKey,
                            'value' => $row[$key]
                        ]);
                        $post->post_meta()->save($post_meta);
                    }
                });

                // attach Panel
                $post->panels()->attach([1, 2]);

                // download Medie
                // $post->addMediaFromUrl($row['img'])->toMediaCollection('posts');
            });
        });
    }



    // return
    //     $events = CSVParser::parse(base_path('imports/events-ar.csv'));
    // $meta = CSVParser::parse(base_path('imports/events-meta-ar.csv'));
    // for ($i = 0; $i < count($events); $i++) {
    //     $events[$i]['post_meta'] = $meta[$i];
    // }

    // foreach ($events as $event) {
    //     $post = Post::create([
    //         'title' => $event['title'],
    //         'slug' => str($event['title'])->slug(2),
    //         'description' => fake(app()->getLocale())->sentence(),
    //         'post_type' => $event['post_type'],
    //         'content' => $event['content'],
    //         'user_id' => 1,
    //         'featured_image' => null,
    //         'published_at' => now(),
    //     ]);

    //     $post->panels()->attach(2);

    //     $post->addMediaFromUrl($event['img'])->toMediaCollection('posts');

    //     foreach ($event['post_meta'] as $key => $value) {
    //         $post->post_meta()->save(PostMeta::create([
    //             'key' => $key,
    //             'value' => $value
    //         ]));
    //     }
    //   }
    // }
}
