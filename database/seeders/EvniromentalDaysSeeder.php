<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Spatie\SimpleExcel\SimpleExcelReader;
class EvniromentalDaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $envDays = SimpleExcelReader::create(base_path('imports/events.csv'))->getRows();
       $local = app()->getLocale();
        $envDays->each(function ($row) use ($local) {
            $envDay = \App\Models\EnviromentalDay::create([
                'title' => $row['title_'.$local] , 
                'month' => Carbon::parse($row['post_meta:event_date'])->englishMonth ,
                'day' => Carbon::parse($row['post_meta:event_date'])->day
            ]);

            $envDay->setTranslation('title', 'en', $row['title_en'])->save();
            
        });
    }
}
