<?php

namespace App\Console\Commands;

use App\Http\Controllers\CustomerReadingsController;
use Exception;
use Illuminate\Console\Command;

class checkCustomerReadings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'read:readings {file_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Customer suspicious readings';

    protected $customerReadingsController;

    public function __construct(CustomerReadingsController $customerReadingsController)
    {
        parent::__construct();
        $this->customerReadingsController = $customerReadingsController;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $customerReadings = $this->customerReadingsController->readCustomerReadingsFile($this->argument('file_name'));

            $headers = ['Client', 'Month', 'Suspicious', 'Median'];
            $readingsAverage = $this->customerReadingsController->getReadingsAverage($customerReadings);

            $data = [];
            foreach ($customerReadings as $customerReading) {
                $data[] = [$customerReading->customerId, $customerReading->month, $customerReading->reading, $readingsAverage];
            }

            $this->table($headers, $data);
        } catch (Exception $ex) {
            $this->error($ex->getMessage());
        }
    }
}
