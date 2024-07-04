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
            'ar' => [
                'فني ',
                'التشبيك مع مؤسسات مالية',
                'أخرى',
                'مالي',
                'برامج للمشاريع الناشئة',
                'أنشطة بناء المجتمع',
                'خدمات',
                'دراسات',
                'تدريبات'
            ],
            'en' => [
                'Technical ',
                'Networking with financial institutions',
                'other',
                'Financial',
                'Programs for emerging projects',
                'Community building activities',
                'services',
                'studies',
                'training'
            ]
        ];

        foreach ($types['ar'] as $i) {
            $t = SUP::create(['name' => $i]);

            $t->setTranslation('name', 'en', $types['en'][array_search($i, $types['ar'])])->save();
        }

        // foreach ($types as $type) {
        //     SUP::create([
        //         'name' => $type,
        //     ]);
        // }
    }
}
