<?php

namespace JagdishJP\SBIPay\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class SbiPayPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sbi-pay:publish {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publishes SB-Pay publishable resources.';

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
        $publishables = ['config', 'controller', 'assets', 'views'];

        $force = $this->option('force');

        foreach ($publishables as $publishable) {

            $parameters = ['--provider' => 'JagdishJP\SBIPay\SBIPayServiceProvider', '--tag' => "sbi-pay-{$publishable}"];

            $this->info("Publishing {$publishable} file.");

            if ($force) {

                if($this->confirm("Force publishing will remove your changes made in $publishable, sure to publish?"))
                $parameters['--force'] = null;
            }

            Artisan::call('vendor:publish', $parameters);
        }

        Artisan::call('optimize');

        $this->info('Publishing completed.');
    }
}
