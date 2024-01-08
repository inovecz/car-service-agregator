<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SupplierLKQProcessingService;


class ProcessSupplierLKQ extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:lkq';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from csv file for supplier LKQ';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $service = new SupplierLKQProcessingService(); 
        $process = $service->process();

        return Command::SUCCESS;
    }
}
