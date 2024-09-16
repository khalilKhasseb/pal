<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Blog\Faq;
use App\Models\Blog\Tag;
class DeleteFaqs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-faqs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // first get all tags for faqs 
        Faq::all()->map(function (Faq $faq) {
            $faq->tags->map(fn(Tag |\Spatie\Tags\Tag $tag) => $tag->delete());

            $faq->delete();
        });
    }
}
