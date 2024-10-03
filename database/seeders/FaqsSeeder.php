<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Classes\CSVParser;
use Google\Service\CustomSearchAPI\Resource\Cse;
use App\Models\Blog\Faq;
use App\Models\Blog\Tag;
use Spatie\SimpleExcel\SimpleExcelReader;

class FaqsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //
        $local = app()->getLocale();
        $transLocal = $local === 'ar'  ? 'en' : $local;

        $rows = SimpleExcelReader::create('imports/faqs.csv')->getRows();


        $rows->each(function ($row) use ($local, $transLocal) {
            $f = Faq::create([
                'question' => $row['question_' . $local],
                'answer' => $row['answer_' . $local]
            ]);
            // setTranslation

            array_map(function ($attr) use ($transLocal, $row, $f) {
                if (array_key_exists($attr . "_" . $transLocal, $row)) {
                    $f->setTranslation($attr, $transLocal, $row[$attr . "_$transLocal"])->save();
                }
            }, $f->getTranslatableAttributes());

            // tags
            $tagParent = Tag::findOrCreateFromString($row['parent_tag_' . $local], 'faq', $local);

            $tagParent->setTranslation('name',$transLocal , $row['parent_tag_' . $transLocal])
                ->setTranslation('slug', $transLocal, str($row['parent_tag_' . $transLocal])->slug('-', $transLocal))
                ->save();
      
                $tagChild = Tag::findOrCreateFromString($row['child_tag_'.$local], 'faq');

            $tagChild->setTranslation('name', $transLocal , $row['child_tag_' . $transLocal])
                ->setTranslation('slug', $transLocal, str($row['child_tag_' . $transLocal])->slug('-', $transLocal))
                ->save();

            $tagParent->panels()->sync([1, 2]);  
            $tagChild->panels()->sync([1, 2]);  

            $tagParent->children()->save($tagChild);

            $f->attachTags([$tagParent, $tagChild]);

            $f->panels()->attach([1, 2]);
        });
    }

   
}
