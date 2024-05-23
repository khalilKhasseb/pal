<?php

namespace Database\Seeders;

use App\Classes\CSVParser;
use App\Models\Supporter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Initiative;
class SupporterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
     // attach supporter to inititaive 
     // attach supported projects and types 

        $supporters = CSVParser::parse(base_path('imports/supporters.csv'));

        foreach($supporters as $supporter) {
            $panel = $supporter['panel'];
            $initiative = Initiative::find($supporter['initiative']);
            $img = $supporter['img'];
            unset($supporter['initiative']);
            unset($supporter['panel']);
            unset($supporter['img']);
            $sup = Supporter::create($supporter);
            $sup->supported_project_types()->attach([fake()->numberBetween(1, 5), fake()->numberBetween(1, 5), fake()->numberBetween(1, 5)]);
            $sup->supported_projects()->attach([fake()->numberBetween(1, 3), fake()->numberBetween(1, 3), fake()->numberBetween(1, 3)]);
            $sup->initiatives()->attach($initiative->id);
            $sup->panels()->attach($panel);
            $sup->addMediaFromUrl($img)->toMediaCollection('supporters');
        }

    }
}
