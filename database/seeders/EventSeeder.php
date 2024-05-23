<?php

namespace Database\Seeders;

use App\Classes\CSVParser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\PostMeta;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = CSVParser::parse(base_path('imports/events-ar.csv'));
        $meta = CSVParser::parse(base_path('imports/events-meta-ar.csv'));
        for ($i = 0; $i < count($events); $i++) {
            $events[$i]['post_meta'] = $meta[$i];
        }

        foreach ($events as $event) {
            $post = Post::create([
                'title' => $event['title'],
                'slug' => str($event['title'])->slug(2),
                'description' => fake(app()->getLocale())->sentence(),
                'post_type' => $event['post_type'],
                'content' => $event['content'],
                'user_id' => 1,
                'featured_image' => null,
                'published_at' => now(),
            ]);

            $post->panels()->attach(2);

            $post->addMediaFromUrl($event['img'])->toMediaCollection('posts');

            foreach ($event['post_meta'] as $key => $value) {
                $post->post_meta()->save(PostMeta::create([
                    'key' => $key,
                    'value' => $value
                ]));
            }

        }

    }
}
