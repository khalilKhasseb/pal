<?php

namespace Database\Seeders;

use App\Classes\CSVParser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\PostMeta;

class AdministrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //admin
        $adminsitartions = CSVParser::parse(base_path('imports/administrations.csv'));
        $meta = CSVParser::parse(base_path('imports/administrations-post_meta.csv'));
        for ($i = 0; $i < count($adminsitartions); $i++) {
            $adminsitartions[$i]['post_meta'] = $meta[$i];
        }

        foreach ($adminsitartions as $ad) {
            $post = Post::create([
                'title' => $ad['title'],
                'slug' => fake()->slug(2),
                'description' => fake(app()->getLocale())->sentence(),
                'post_type' => $ad['post_type'],
                'content' => $ad['content'],
                'user_id' => 1,
                'featured_image' => null,
                'published_at' => now(),
            ]);

            $post->addMediaFromUrl($ad['featured_img'])->toMediaCollection('posts');

            $post->panels()->attach($ad['panel']);

            foreach ($ad['post_meta'] as $key => $value) {
                $post->post_meta()->save(PostMeta::create([
                    'key' => $key,
                    'value' => $value
                ]));
            }

        }
    }
}
