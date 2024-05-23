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
        $init = ['اخرى', 'شركات', 'افراد']; 

        foreach($init as $i) {
            Initiative::create([
                'title' => $i,
                'slug' => str($i)->slug(),
                'type' => $i
            ]);
        }
    }
}
