<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
class PartnerDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:partner-delete';

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
        $parnter = Post::partner()->get()->map(function($post) {
            $post->delete();
        });
    }
}
