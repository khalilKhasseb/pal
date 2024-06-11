<?php

namespace Database\Seeders;

use App\Classes\CSVParser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\PostMeta;
use Spatie\SimpleExcel\SimpleExcelReader;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = SimpleExcelReader::create('imports/posts-en-ar.csv')->getRows();
        $local = app()->getLocale();

        $rows->each(function ($row) use ($local) {
            DB::transaction(function () use ($row, $local) {
                $post = Post::create([
                    'title' => $row['title_' . $local],
                    'slug' => str($row['title_' . $local])->slug(),
                    'description' => fake(app()->getLocale())->sentence(),
                    'post_type' => 'post',
                    'content' => $row['content_' . $local],
                    'user_id' => 1,
                    'featured_image' => null,
                    'published_at' => isset($row['publish_date']) ? $row['publish_date'] : now(),
                ]);

                // set translation
                $post->setTranslation('title', 'en', $row['title_en'])->save();
                $post->setTranslation('content', 'en', $row['content_en'])->save();
                // post meta
                $post_meta_keys = array_filter(array_keys($row), fn ($meta) => str_contains($meta, 'post_meta'));
                if (!empty($post_meta_keys)) :
                    foreach ($post_meta_keys as $key) {
                        // $key = str_contains($key, $local) ? str_replace("_" . $local, "", $key) : $key;
                        if (str_contains($key, $local)) {
                            $key =  str_replace("_" . $local, "", $key);
                            $post_meta = PostMeta::create([
                                "key" => str(substr($key, strpos($key, ":") + 1))->value(),
                                "value" => $row[$key . "_" . $local]
                            ]);


                            $post_meta->setTranslation('key', 'en', $key . "_en");
                            $post_meta->setTranslation('value', 'en', $row[$key . "_en"]);
                            $post->post_meta()->save($post_meta);
                        }
                    }
                endif;
                // attach panel
                $post->panels()->attach($row['panel']);
                if (isset($row['img'])) {


                    try {
                        $post->addMediaFromUrl($row['img'])->toMediaCollection('posts');
                    } catch (\Exception $exception) {
                    }
                }
            });
        });
      
    }

    public function parse_post_meta($meta)
    {
    }
}
