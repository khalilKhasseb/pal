<?php

namespace Database\Seeders;

use App\Classes\CSVParser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use Exception;
use Spatie\SimpleExcel\SimpleExcelReader;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $local = app()->getLocale();
        $transLocal = $local === 'ar'  ? 'en' : $local;
        $rows = SimpleExcelReader::create('imports/partners.csv')->getRows();

        $rows->each(function ($row) use ($local, $transLocal) {
            $post = Post::create([
                'title' => $row['title_' . $local],
                'content' => $row['content_' . $local],
                'post_type' => 'partner',
                'slug' => str($row['title_'.$local])->slug('-', 'en'),
                'user_id' => 1,
                'featured_image' => null,
                'published_at' => now(),
            ]);
            // set translation

            array_map(function ($attr) use ($transLocal, $post, $row) {
                if (array_key_exists($attr . "_$transLocal", $row)) {
                    $post->setTranslation($attr, $transLocal, $row[$attr . "_$transLocal"])->save();
                }
            }, $post->getTranslatableAttributes());
            $post->panels()->attach([1, 2]);
            $post->addMediaFromUrl($row['img'])->toMediaCollection('posts');
        });

       
    }
}
