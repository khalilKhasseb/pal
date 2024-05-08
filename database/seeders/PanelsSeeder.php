<?php

namespace Database\Seeders;

use App\Models\Panel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Filament\Facades\Filament;
class PanelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $panels  = Filament::getPanels() ;

        foreach($panels as $panel) {
            Panel::create([
              'panel_id' => $panel->getId(),
              'panel_name' => $panel->getPath()
            ]);
        }
    }
}
