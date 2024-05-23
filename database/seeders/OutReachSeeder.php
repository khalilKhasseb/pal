<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Classes\CSVParser;
use App\Models\Post;

class OutReachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $outreacs = CSVParser::parse(base_path('imports/outreach-ar'));

        foreach($outreacs as $outreach) {
            if($outreach['panel'] === 'admin') {
            $o =  Post::create([
                'title' => "المجلس - " . $outreach['title'],
                'slug' => fake()->slug(2),
                'description' => fake(app()->getLocale())->sentence(),
                'post_type' => 'activity',
                'content' => $outreach['content'],
                'user_id' => 1,
                'featured_image' => null,
                'published_at' => now(),
            ]);
                $o->panels()->attach(1);
                $o->attachTag('مشاريع محلية');
            }

            if($outreach['panel'] === 'sommod') {
                $s = Post::create([
                    'title' => "صمود - " . $outreach['title'],
                    'slug' => fake()->slug(2),
                    'description' => fake(app()->getLocale())->sentence(),
                    'post_type' => 'activity',
                    'content' => $outreach['content'],
                    'user_id' => 1,
                    'featured_image' => null,
                    'published_at' => now(),
                ]);

                $s->panels()->attach(2);
                $s->attachTag('مشاريع محلية');
            }
        }
    }
}
