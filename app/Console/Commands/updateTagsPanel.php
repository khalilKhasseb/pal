<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class updateTagsPanel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-tags-panel';

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
        $panel = \App\Models\Panel::findById(filament()->getCurrentPanel()->getId());
        $panel
            ->faqs()
            ->first()
            ->get()
            ->each(function ($item) use ($panel) {
                // get tags of item 
                $id = $panel->id;
                dd($item->tags);
                $item->tags()
                    ->get()
                    ->each(function ($tag) use ($id) {
                         $tag->panels()->attach($id);
                        dd($tag->panels()->get());
                        
                    });
            });
    }
}
