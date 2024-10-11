<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;
use Database\Seeders\ProductSeeder as Seeder;
use function Safe\file_get_contents;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected $post_type = 'service';
    protected $file_name = 'services.csv';
    protected $panels = [1, 2];
    public function run(): void
    {
        parent::run();
    }
}
