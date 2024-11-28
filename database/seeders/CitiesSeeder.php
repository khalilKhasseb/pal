<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\SimpleExcel\SimpleExcelReader;
use App\Models\City;
use App\Models\Governorate;
use Illuminate\Database\QueryException;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = SimpleExcelReader::create(base_path('imports/cities.csv'));

        [$state_en, $name_en, $state_ar, $name_ar] = $cities->getHeaders();

        $cities->getRows()->each(function ($row) use ($state_en, $name_en, $name_ar) {

            try {
                $city = City::create([
                    'name' => $row[$name_ar],
                    'slug' => str($row[$name_en])->slug('-', 'en')->value(),
                ]);
                $city->setTranslation('name', 'en', $row[$name_en])
                    ->save();

                $governorate = Governorate::findBySlug(str($row[$state_en])->slug('-', 'en')->value());

                $governorate->cities()->save($city);

                // $governorate->country->cities()->save($city);
            } catch (QueryException $e) {
                if ($e instanceof QueryException && $e->getCode() === 23000) {
                    $slug = str($row[$name_en] . ' ' . $row[$state_en])->slug('-', 'en');

                    $city = City::create([
                        'name' => $row[$name_ar],
                        'slug' => $slug,
                    ]);
                    $city->setTranslation('name', 'en', $row[$name_en])
                        ->save();

                    $governorate = Governorate::findBySlug(str($row[$state_en])->slug('-', 'en')->value());

                    $governorate->cities($city);

                    $governorate->country->cities()->save($city);
                }

            }

            // save governorate ;

        });
    }

}
