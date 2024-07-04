<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\SimpleExcel\SimpleExcelReader;
use App\Models\Blog\Tag;
use App\Models\Blog\Library;

class LibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = SimpleExcelReader::create('imports/memebr_library_en_ar.csv')->getRows();

        $local = app()->getLocale();

        $rows->each(function ($row) use ($local) {

            $tag = Tag::findOrCreateFromString($row['tag_name_' . $local], 'library');

            // translate tag ;
            $tag->setTranslation('name', 'en', $row['tag_name_en']);
            // create libraray


            $library = Library::create([
                'slug' => str($row['title_' . $local])->slug()->value(),
                'title' => $row['title_' . $local],
                'description' => $row['title_' . $local],
                'type' => 'url',
                'file_path' => $row['file_path'],
            ]);

            // setTranslation for library

            $library->setTranslation('title', 'en', $row['title_en'])
                ->setTranslation('description', 'en', $row['title_en'])
                ->save();


            $library->tags()->attach($tag);

            $library->panels()->attach([1,2]);
        });
        //first create library tags and set translation for library tags

        // $this->libraryTags($tags) ;

        // insert library to databae

        // $this->seedLibToDataBase($libs) ;

        // Asing each library to its tag

        // $this->assingLibToTag($lib , $tag);
    }


    protected function libraryTags($tags)
    {
    }

    protected function seedLibToDataBase($libs)
    {

        //    $this->assingLibToTag($tag , $lib) ;
    }

    protected function assingLibToTag($lib, $tag)
    {
    }
}
