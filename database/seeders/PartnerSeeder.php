<?php

namespace Database\Seeders;

use App\Classes\CSVParser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = CSVParser::parse(base_path('imports/partners.csv'));

        foreach($partners as $partner) {
            $post =Post::create([
                'title' => $partner['title'],
                'content' => $partner['content'],
                'post_type' => $partner['post_type'],
                'slug' => str($partner['title'])->slug(),
                'user_id' => 1,
                'featured_image' => null,
                'published_at' => now(),
            ]);

            $post->panels()->attach($partner['panel']);
            $post->addMediaFromUrl($partner['img'])->toMediaCollection('partners');


        }

    }
}
