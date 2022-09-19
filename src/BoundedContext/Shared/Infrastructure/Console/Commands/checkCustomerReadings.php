<?php

namespace Src\BoundedContext\Shared\Infrastructure\Console\Commands;

use App\Helpers\SuspiciousReadingsHelper;
use Exception;
use Illuminate\Console\Command;
use Src\BoundedContext\CustomerReadings\Infrastructure\Controllers\ReadCustomerReadingsFileController;

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

    protected $readCustomerReadingsFile;

    public function __construct(ReadCustomerReadingsFileController $readCustomerReadingsFile)
    {
        parent::__construct();
        $this->readCustomerReadingsFile = $readCustomerReadingsFile;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $customerReadings = $this->readCustomerReadingsFile->__invoke($this->argument('file_name'));

            //Call helper to sort array with suspicious readings
            SuspiciousReadingsHelper::sortSuspiciousReadings($customerReadings);

            $headers = ['Client', 'Month', 'Suspicious', 'Median'];
            $readingsAverage = SuspiciousReadingsHelper::getReadingsAverage($customerReadings);

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
