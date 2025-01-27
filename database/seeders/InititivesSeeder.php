<?php

 namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Initiative;

class InititivesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $init = [
            'ar' => ['اخرى', 'شركات', 'افراد'],
            'en' => ['Others', 'Companies', 'Individuals']
        ];

        foreach ($init['ar'] as $i) {
            $_init =  Initiative::create([
                'title' => $i,
                'slug' => str($i)->slug(),
                'type' => $i
            ]);

            $_init->panels()->attach([1, 2]);

            $_init->setTranslation('title', 'en', $init['en'][array_search($i, $init['ar'])])->save();
        }
    }
}
