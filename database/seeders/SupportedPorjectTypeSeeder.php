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
        $types = array("غير محدد", "التصنيع", "تكنولوجيا المعلومات", "خدمات (سياحة)", "شركات ناشئة", "مبادرات مجتمعية", "بيئية", "مستدامة", "بنية تحتية", "اخرى", "مجالات الاستدامة بشكل عام", "تكنولوجيا البناء", "مجال الزراعة", "مشاريع ريادية", "الشباب والفئات المهمشة", "مجال مواد البناء", "مشاريع زراعية", "مجال الطاقة الشمسية", "،مجال الالكترونيات");

      foreach($types as $type) {
            T::create(['name' => $type]);
      }
    }
}
