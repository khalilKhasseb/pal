<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Classes\CSVParser;
use App\Models\Post;
use App\Models\PostMeta;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   
    public function run(): void
    {
        $product_csv = base_path('imports/productsandservices.csv');

        $products = CSVParser::parse($product_csv);

        $products_meta = CSVParser::parse(base_path('imports/product-meta-ar'));


        // map each meta to product as a key or post_meta has value of all value of post meta

        for($i = 0 ; $i < count($products) ; $i++) {
            $products[$i]['post_meta'] = $products_meta[$i]; 
        }

       

        //create porudcts 

        foreach($products as $product) {
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

            foreach($product['post_meta'] as $key => $value) {
                $post->post_meta()->save(PostMeta::create([
                    'key' => $key,
                    'value' => $value
                ]));
            }

        }
        //
    }
}
