<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Governorate;
use Spatie\SimpleExcel\SimpleExcelReader;
class GovernoratesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $governorates = SimpleExcelReader::create(base_path('imports/states.csv'));

        $headers = $governorates->getHeaders();

        $rows = $governorates->getRows();

        [$name_en, $name_ar] = $headers;

        $rows->each(function ($row) use ($name_ar, $name_en) {
            $governorate = Governorate::create([
                'name' => $row[$name_ar],
                'slug' => str($row[$name_en])->slug('-', 'en')->value(),

            ]);

            $governorate->setTranslation('name', 'en', $row[$name_en])->save();

            // Country::first()->governorates()->save($governorate);
        });

    }

}
