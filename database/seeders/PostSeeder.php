<?php

namespace Database\Seeders;

use App\Classes\CSVParser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // handle 
        $posts = CSVParser::parse('imports/posts-ar.csv');  
        
        foreach ($posts as $post) {
           
            $_p = Post::create([
                'title' => $post['title'] ,
                'slug' => str($post['title'])->slug(),
                'description' => fake(app()->getLocale())->sentence(),
                'post_type' => $post['post_type'],
                'content' => $post['content'],
                'user_id' => $post['user_id'],
                'featured_image' => null,
                'published_at' => now(),
            ]);

            $_p->panels()->attach($post['panel']);

            $_p->addMediaFromUrl($post['featured_image'])->toMediaCollection('posts');

        }

    }

    private function parse_csv() : array{
        $data = [];
        $file = fopen(base_path('posts-ar.csv') , 'r');

        // loop to get data 
        $row = 0;
        while(!feof($file)) {
            $csv_file = fgetcsv($file, 1000, ','); 
            if(!empty($csv_file)) {
                // check for fist entry to map to props 
                if($row == 0 ) {
                    $data['attribute'] = $csv_file;
                }else {
                    // map vlues to new keys
                    //$data[] = $csv_file;
                    $item = [];
                   foreach($csv_file as $key => $value) {
                        $item[$data['attribute'][$key]] = $value;  
                   }
                    $data[] = $item;
                 }  
            }
            $row++;
        }
        fclose($file);
        unset($data['attribute']);
        // dd($data);
        return $data;
    }
}
