<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Classes\CSVParser;
use App\Models\Cource;
use Spatie\SimpleExcel\SimpleExcelReader;
use Illuminate\Support\Facades\DB;

class CourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // get rows
        $rows = SimpleExcelReader::create('imports/courcess.csv')->getRows();

        // map throw rows to insert eneites to databse
        $local = app()->getLocale();
        $rows->each(function ($row) use ($local) {

            DB::transaction(function () use ($row, $local) {

                $cources = Cource::create([
                    'title' => $row['title_' . $local],
                    'location' => $row['location_' . $local],
                    'trainer' => $row['trainer_' . $local],
                    'target_audince' => $row['target_audince_' . $local],
                    'partners' => $row['partners_' . $local],
                    'start_date' => $row['start_date'],
                    'end_date' => null,
                    'fees' => $row['fees'],
                    'scholership' => false,
                    'scholership_link' => null,
                    'hours' => $row['hours_' . $local],
                    'objective' => $row['hours_' . $local],
                    'content' => $row['content_' . $local],
                    'google_form_id' => null
                ]);

                // setTranslation
                array_map(function ($attr) use ($cources, $row, $local) {
                    $cources->setTranslation($attr, 'en', $row[$attr . "_en"])->save();
                }, $cources->getTranslatableAttributes());

                $cources->panels()->attach($row['panel']);

                try {
                    $cources->addMediaFromUrl($row['img'])->toMediaCollection('cources');
                } catch (\Exception $excpetion) {
                }
            });

            // attach panel

        });

        return;



        $cources = CSVParser::parse(base_path('imports/cources-ar.csv'));

        array_map(function ($cource) {
            $panel = $cource['panel'];
            $img = $cource['img'];
            unset($cource['img']);
            unset($cource['panel']);

            $c = Cource::create($cource);
            $c->panels()->attach($panel === 'sommod' ? 2 : 1);
            try {

                $c->addMediaFromUrl($img)->toMediaCollection('cources');
            } catch (\Exception $excpetion) {
            }
            return $cource;
        }, $cources);
    }
}
