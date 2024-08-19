<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeleteModelContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-model-content {model} {--type=}';

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
        //
        $model = str($this->argument('model'))->ucfirst();
        $m = app('App\Models\\' . $model);

        $m->where('post_type', $this->option('type'))->get()->each(function ($item) {
            $item->clearMediaCollection();
            $item->delete();
        });
    }
}
