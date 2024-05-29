<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Classes\CSVParser;
use Google\Service\CustomSearchAPI\Resource\Cse;
use App\Models\Blog\Faq;
use App\Models\Blog\Tag;

class FaqsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $question = 'question';
        $answer = 'answer';

        $faqs = CSVParser::parse(base_path('imports/faqs-ar.csv'));

        foreach ($faqs as $faq) {
            $_faqModel = Faq::create([
                'question' => $faq['question'],
                'answer' => $faq['answer']
            ]);

            $tagParent = Tag::findOrCreateFromString($faq['parent'], 'faq');
            $tagChild = Tag::findOrCreateFromString($faq['child'], 'faq');
            $tagParent->children()->save($tagChild);
            $_faqModel->attachTags([$tagParent, $tagChild]);
        }
    }
}
