<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\SystemUser;
use Illuminate\Database\Seeder;
use Database\Seeders\SkySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $this->call([

            //  RolesSeeder::class,
            //  PanelsSeeder::class,
             SupportedPorjectTypeSeeder::class,
             SupportedProject::class,
            InititivesSeeder::class,

            PostSeeder::class,
            ProductSeeder::class,
            EventSeeder::class,
            HallSeeder::class,
            AdministrationSeeder::class,

            SupporterSeeder::class,
            OutReachSeeder::class,
            CourceSeeder::class,

            PartnerSeeder::class,

        ]);
    }
}
