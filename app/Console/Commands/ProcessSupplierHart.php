<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SupplierHartProcessingService;


class ProcessSupplierHart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:hart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from csv file for supplier Hart';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $service = new SupplierHartProcessingService(); 
        $process = $service->process();

        return Command::SUCCESS;
    }
}
