<?php

namespace App\Console\Commands;

use App\Models\City;
//use App\Utilities\SimpleTextMailer;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Artisan;

class ApplicationInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app-install {ecommerce=false}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Goes through all php artisan commands needed to install the app';

    /**
     * @var Logger
     */
    private Logger $logger;

    /**
     * Create a new command instance.
     *

     * @param Logger $logger
     */
    public function __construct( Logger $logger)
    {
        parent::__construct();
        $this->logger = $logger;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $this->info('Started app install');

            Artisan::call('migrate:fresh');
            $this->info(Artisan::output());

            if ($this->argument('ecommerce') == 'false'){
                Artisan::call('synchronize-basic-permissions');
            } else {
                Artisan::call('synchronize-ecommerce-permissions');
            }

            $this->info(Artisan::output());

            Artisan::call('synchronize-roles');
            $this->info(Artisan::output());

            Artisan::call('synchronize-settings');
            $this->info(Artisan::output());

            Artisan::call('db:seed');
            $this->info(Artisan::output());
        } catch (\Exception $exception) {
            $this->info($exception);
        }

        return $this->info('Finished app install');
    }
}
