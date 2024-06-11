<?php

namespace Database\Seeders;

use App\Classes\CSVParser;
use App\Models\Supporter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Initiative;
use App\Models\SupportedProjectType;
use Spatie\SimpleExcel\SimpleExcelReader;
use App\Models\SupportedProject;

class SupporterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // attach supporter to inititaive
        // attach supported projects and types

        $local = app()->getLocale();
        $transLocal = $local === 'ar'  ? 'en' : $local;
        $rows = SimpleExcelReader::create('imports/initiatives_items.csv')->getRows();



        $rows->each(function ($row) use ($local, $transLocal) {

            $sup = Supporter::create([
                'name' => $row['name_' . $local],
                'location' => $row['location_' . $local],
                'website' => $row['webiste'],
                'about' => $row['about_' . $local],
                'contact_info' => $row['contact_info'],
                'phone' => $row['phone']
            ]);

            // set Trannslatin

            array_map(function ($attr) use ($transLocal, $row, $sup) {
                if (array_key_exists($attr . "_" . $transLocal, $row)) {
                    $sup->setTranslation($attr, $transLocal, $row[$attr . "_$transLocal"])->save();
                }
            }, $sup->getTranslatableAttributes());

            // attach panel

            $countTypesStart = SupportedProjectType::first()->id;
            $countTypesEnd = SupportedProjectType::all()->last()->id;


            $SupportedProjectStart = SupportedProject::first()->id;
            $SupportedProjectTypeEnd = SupportedProject::all()->last()->id;

            $inititivesStart = Initiative::first()->id;
            $inititivesEnd = Initiative::all()->last()->id;

            $sup->supported_project_types()->attach([fake()->numberBetween($countTypesStart, $countTypesEnd), fake()->numberBetween($countTypesStart, $countTypesEnd), fake()->numberBetween($countTypesStart, $countTypesEnd)]);
            $sup->supported_projects()->attach([fake()->numberBetween($SupportedProjectStart, $SupportedProjectTypeEnd), fake()->numberBetween($SupportedProjectStart, $SupportedProjectTypeEnd), fake()->numberBetween($SupportedProjectStart, $SupportedProjectTypeEnd)]);
            $sup->initiatives()->attach([fake()->numberBetween($inititivesStart, $inititivesEnd)]);

            $sup->panels()->attach([1, 2]);

            $sup->addMediaFromUrl($row['img'])->toMediaCollection('supporters');
        });
    }

    //     $supporters = CSVParser::parse(base_path('imports/supporters.csv'));

    //     foreach ($supporters as $supporter) {
    //         $panel = $supporter['panel'];
    //         $initiative = Initiative::find($supporter['initiative']);
    //         $img = $supporter['img'];
    //         unset($supporter['initiative']);
    //         unset($supporter['panel']);
    //         unset($supporter['img']);
    //         $sup = Supporter::create($supporter);
    //         $sup->supported_project_types()->attach([fake()->numberBetween(1, 5), fake()->numberBetween(1, 5), fake()->numberBetween(1, 5)]);
    //         $sup->supported_projects()->attach([fake()->numberBetween(1, 3), fake()->numberBetween(1, 3), fake()->numberBetween(1, 3)]);
    //         $sup->initiatives()->attach($initiative->id);
    //         $sup->panels()->attach($panel);
    //         try {

    //             $sup->addMediaFromUrl($img)->toMediaCollection('supporters');
    //         } catch (\Exception $exception) {
    //         }
    //     }
    // }
}
