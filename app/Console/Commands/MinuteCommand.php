<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MinuteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minute:queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fire queue listen every minute';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        \Artisan::call('queue:work', [
            '--stop-when-empty' => true
        ]);

    }
}
