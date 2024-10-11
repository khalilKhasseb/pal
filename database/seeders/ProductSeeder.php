<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Classes\CSVParser;
use App\Models\Post;
use App\Models\PostMeta;
use Spatie\SimpleExcel\SimpleExcelReader;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected $post_type = 'product';
    protected $file_name = 'products.csv';

    protected $panels = [1, 2];
    public function run(): void
    {
        // get products as roew
        
        $local = app()->getLocale();

        $rows = SimpleExcelReader::create("imports/{$this->file_name}")->getRows();

        $rows->each(function ($row) use ($local) {
            // create post memeber


            $post_meta_keys = collect(array_filter(array_keys($row), fn ($key) => str_contains($key, 'post_meta')));

            $post = Post::create([
                'title' => $row['title_' . $local],
                'slug' => str($row['title_' . $local])->slug(),
                'description' => fake(app()->getLocale())->sentence(),
                'post_type' => $this->post_type,
                'content' => $row['content_' . $local],
                'user_id' => 1,
                'featured_image' => null,
                'published_at' => now(),
            ]);

            // // setTranlsation for post

            $post->setTranslation('title', 'en', $row['title_en'])
                ->setTranslation('content', 'en', $row['content_en'])
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
                }
            });

            // AttachPanel
            $post->panels()->attach($this->panels);

            // attach media

            try {
                $post->addMediaFromUrl($row['img'])->toMediaCollection('posts');
            } catch (\Exception $exception) {
            }
        });

















        return;
        $product_csv = base_path('imports/productsandservices.csv');

        $products = CSVParser::parse($product_csv);

        $products_meta = CSVParser::parse(base_path('imports/product-meta-ar'));


        // map each meta to product as a key or post_meta has value of all value of post meta

        for ($i = 0; $i < count($products); $i++) {
            $products[$i]['post_meta'] = $products_meta[$i];
        }



        //create porudcts

        foreach ($products as $product) {
            $post = Post::create([
                'title' => $product['title'],
                'slug' => str($product['title'])->slug(2),
                'description' => fake(app()->getLocale())->sentence(),
                'post_type' => $product['post_type'],
                'content' => $product['content'],
                'user_id' => 1,
                'featured_image' => null,
                'published_at' => now(),
            ]);

            $post->panels()->attach(1);

            $post->addMediaFromUrl($product['img'])->toMediaCollection('posts');

            foreach ($product['post_meta'] as $key => $value) {
                $post->post_meta()->save(PostMeta::create([
                    'key' => $key,
                    'value' => $value
                ]));
            }
        }
        //
    }
}
