<?php

namespace Database\Seeders;

use App\Classes\CSVParser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\PostMeta;
use Spatie\SimpleExcel\SimpleExcelReader;
use Illuminate\Support\Facades\DB;
use App\Models\Blog\Tag;

class HallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {





        $local = app()->getLocale();
        $transLocal = $local === 'ar'  ? 'en' : $local;
        $rows = SimpleExcelReader::create('imports/halls-all.csv')->getRows();

        // map throw each row to inser entites

        $rows->each(function ($row) use ($local, $transLocal) {
            // $post_meta_keys = collect(array_filter(array_keys($row), fn ($key) => str_contains($key, 'post_meta')));

            DB::transaction(function () use ($row, $local, $transLocal) {

                // create event
                $post = Post::create([
                    'title' => $row['title_' . $local],
                    'slug' => str($row['title_' . $local])->slug('-' , 'en'),
                    'description' => fake($local)->sentence(),
                    'post_type' => 'hall',
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
                // tags
                $tagParent = Tag::findOrCreateFromString($row['tag_title_' . $local], 'hall');
                $tagParent->setTranslation('name', $transLocal, $row['tag_title_' . $transLocal])->save();
                $post->tags()->attach($tagParent);
                // attach Panel
                $post->panels()->attach([1, 2]);

                $post->addMediaFromUrl($row['img'])->toMediaCollection('posts');
            });
        });
    }


}
