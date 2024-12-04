<?php

namespace Database\Seeders;

use App\Models\ExpertCirtificate;
use Database\Factories\CertificatesFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Storage;

class ExpertsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $experts = \App\Models\Expert::factory(10)
            ->withMedia()
            ->has(ExpertCirtificate::factory()->count(3), 'certificates')
            ->create(['gender' => 'male']);

        
    }
}
