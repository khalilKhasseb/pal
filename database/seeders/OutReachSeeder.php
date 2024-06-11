<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Classes\CSVParser;
use App\Models\Post;
use Spatie\SimpleExcel\SimpleExcelReader;
use Illuminate\Support\Facades\DB;
use App\Models\Blog\Tag;

class OutReachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $rows = SimpleExcelReader::create('imports/outreach.csv')->getRows();
        $local = app()->getLocale();
        $transLocal = $local === 'ar'  ? 'en' : $local;

        $rows->each(function ($row) use ($local, $transLocal) {
            DB::transaction(function () use ($row, $local, $transLocal) {
                $post = Post::create([
                    'title' => $row['title_' . $local],
                    'slug' => str($row['title_' . $local])->slug(),
                    'description' => fake(app()->getLocale())->sentence(),
                    'post_type' => 'activity',
                    'content' => $row['content_' . $local],
                    'user_id' => 1,
                    'featured_image' => null,
                    'published_at' => isset($row['publish_date']) ? $row['publish_date'] : now(),
                ]);

                // setTranslation
                array_map(function ($attr) use ($transLocal, $row, $post) {
                    if (array_key_exists($attr . "_" . $transLocal, $row)) {
                        $post->setTranslation($attr, $transLocal, $row[$attr . "_$transLocal"])->save();
                    }
                }, $post->getTranslatableAttributes());

                // tags
                $tagParent = Tag::findOrCreateFromString($row['tag_' . $local], 'activity');
                $tagParent->setTranslation('name', $transLocal, $row['tag_' . $transLocal])->save();
                $post->tags()->attach($tagParent);

                $post->panels()->attach([1, 2]);

                // imgae
                $post->addMediaFromUrl($row['img'])->toMediaCollection('posts');
            });
        });


















        // $outreacs = CSVParser::parse(base_path('imports/outreach-ar'));

        // foreach($outreacs as $outreach) {
        //     if($outreach['panel'] === 'admin') {
        //     $o =  Post::create([
        //         'title' => "المجلس - " . $outreach['title'],
        //         'slug' => fake()->slug(2),
        //         'description' => fake(app()->getLocale())->sentence(),
        //         'post_type' => 'activity',
        //         'content' => $outreach['content'],
        //         'user_id' => 1,
        //         'featured_image' => null,
        //         'published_at' => now(),
        //     ]);
        //         $o->panels()->attach(1);
        //         $o->attachTag('مشاريع محلية');
        //     }

        //     if($outreach['panel'] === 'sommod') {
        //         $s = Post::create([
        //             'title' => "صمود - " . $outreach['title'],
        //             'slug' => fake()->slug(2),
        //             'description' => fake(app()->getLocale())->sentence(),
        //             'post_type' => 'activity',
        //             'content' => $outreach['content'],
        //             'user_id' => 1,
        //             'featured_image' => null,
        //             'published_at' => now(),
        //         ]);

        //         $s->panels()->attach(2);
        //         $s->attachTag('مشاريع محلية');
        //     }
        // }
    }
}
