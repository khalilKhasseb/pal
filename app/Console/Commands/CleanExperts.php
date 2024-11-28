<?php

namespace App\Console\Commands;

use App;
use Illuminate\Console\Command;

class CleanExperts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-experts';

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
        App\Models\Expert::query()->delete();
    }
}
