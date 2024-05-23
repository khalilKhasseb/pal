<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SupportedProject as SUP;
class SupportedProject extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'فني ',
            ' التشبيك مع مؤسسات مالية',
            'أخرى',
            'مالي',
            'برامج للمشاريع الناشئة',
            'أنشطة بناء المجتمع',
            'خدمات',
            'دراسات',
            'تدريبات'
        ];
       
     foreach($types as $type) {
           SUP::create([
                'name' => $type,
            ]);
     }
    }
}
