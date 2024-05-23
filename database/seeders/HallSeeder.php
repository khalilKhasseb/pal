<?php

namespace Database\Seeders;

use App\Classes\CSVParser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class HallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $halls = CSVParser::parse(base_path('imports/halls.csv'));


        foreach ($halls as $hall) {
            $post = Post::create([
                'title' => $hall['title'],
                'slug' => fake()->slug(2),
                'description' => fake(app()->getLocale())->sentence(),
                'post_type' => $hall['post_type'],
                'content' => $hall['content'],
                'user_id' => 1,
                'featured_image' => null,
                'published_at' => now(),
            ]);

            $post->addMediaFromUrl($hall['img'])->toMediaCollection('posts');
            $post->attachTag($hall['tag'] , 'category');

            $post->panels()->attach($hall['panel']);
        }
    }
}
