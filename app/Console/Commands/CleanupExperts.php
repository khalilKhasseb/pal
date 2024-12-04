<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Expert;

class CleanupExperts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cleanup:experts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all experts along with their media and certificates';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting cleanup of all experts, media, and certificates.');

        // Fetch all experts
        $experts = Expert::all();

        if ($experts->isEmpty()) {
            $this->info('No experts found to delete.');
            return static::SUCCESS;
        }

        $experts->each(function ($expert) {
            // Delete associated certificates
            $expert->certificates()->delete();

            // Delete associated media
            $expert->clearMediaCollection();

            // Delete the expert
            $expert->delete();
        });

        $this->info('All experts, their media, and certificates have been deleted.');

        return static::SUCCESS;
    }
}
