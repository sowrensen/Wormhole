<?php

namespace Sowren\Wormhole\Console\Commands;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wormhole:publish
                            {type : The preset type, uikit or bootstrap}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publishes the built-in package resources';

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
     * @return void
     */
    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => $this->argument('type') == 'uikit' ? 'wormhole-uikit' : 'wormhole-bootstrap'
        ]);

        $this->info('Preset vue component is published');
    }
}

