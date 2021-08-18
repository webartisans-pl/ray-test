<?php

namespace App\Console\Commands\Ray;

use Illuminate\Console\Command;

class RayTestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ray:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test ray in commands';

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
     * @return int
     */
    public function handle()
    {
        ray("Test command")->red();

        return 0;
    }
}
