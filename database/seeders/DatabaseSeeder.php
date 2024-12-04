<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\SystemUser;
use Illuminate\Database\Seeder;
use Database\Seeders\SkySeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        SystemUser::create([
            'name' => "khalil",
            'email' => 'k@k.com',
            'password' => Hash::make(1),
        ]);

        $this->call([

            RolesSeeder::class,
            PanelsSeeder::class,
            SupportedPorjectTypeSeeder::class,
            SupportedProject::class,
            InititivesSeeder::class,
            GovernoratesSeeder::class,
            CitiesSeeder::class,

            ExpertsSeeder::class, 
            LibrarySeeder::class,

            PostSeeder::class,
            ProductSeeder::class,
            EventSeeder::class,
            HallSeeder::class,
            AdministrationSeeder::class,

            SupporterSeeder::class,
            OutReachSeeder::class,
            CourceSeeder::class,

            PartnerSeeder::class,
            FaqsSeeder::class

        ]);
    }
}
