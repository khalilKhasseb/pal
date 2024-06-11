<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Classes\CSVParser;
use App\Models\Cource;

class CourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cources = CSVParser::parse(base_path('imports/cources-ar.csv'));

        array_map(function ($cource) {
            $panel = $cource['panel'];
            $img = $cource['img'];
            unset ($cource['img']);
            unset ($cource['panel']);

            $c = Cource::create($cource);
            $c->panels()->attach($panel === 'sommod' ? 2 : 1);
            try{

                $c->addMediaFromUrl($img)->toMediaCollection('cources');
            }catch(\Exception $excpetion){}
            return $cource;
        }, $cources);


    }
}
