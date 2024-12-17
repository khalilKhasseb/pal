<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AfterDeleteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            PostSeeder::class, // post
            ProductSeeder::class, // post           
            HallSeeder::class, // post
            AdministrationSeeder::class, //post

        ]);
    }
}
