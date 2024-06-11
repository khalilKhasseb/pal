<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SupportedProjectType as T;

class SupportedPorjectTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $types = array();
        $types = [
            'en' => ["Unspecified", "Manufacturing", "Information Technology", "Services (Tourism)", "Start-ups", "Community Initiatives", "Environmental", "Sustainable", "Infrastructure", "Others", "Fields Sustainability in general", "building technology", "the field of agriculture", "pioneer projects", "youth and marginalized groups", "the field of building materials", "agricultural projects", "the field of solar energy", "the field of electronics"],
            'ar' => ["غير محدد", "التصنيع", "تكنولوجيا المعلومات", "خدمات (سياحة)", "شركات ناشئة", "مبادرات مجتمعية", "بيئية", "مستدامة", "بنية تحتية", "اخرى", "مجالات الاستدامة بشكل عام", "تكنولوجيا البناء", "مجال الزراعة", "مشاريع ريادية", "الشباب والفئات المهمشة", "مجال مواد البناء", "مشاريع زراعية", "مجال الطاقة الشمسية", "،مجال الالكترونيات"]
        ];

        foreach ($types['ar'] as $i) {
            $t = T::create(['name' => $i]);

            $t->setTranslation('name', 'en', $types['en'][array_search($i, $types['ar'])])->save();
        }
    }
}
