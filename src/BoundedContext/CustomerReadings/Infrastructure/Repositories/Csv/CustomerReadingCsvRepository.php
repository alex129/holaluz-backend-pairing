<?php 

namespace Src\BoundedContext\CustomerReadings\Infrastructure\Repositories\Csv;

use Carbon\Carbon;
use Src\BoundedContext\CustomerReadings\Domain\Contracts\CustomerReadingsRepositoryContract;
use Src\BoundedContext\CustomerReadings\Domain\CustomerReading;

class CustomerReadingCsvRepository implements CustomerReadingsRepositoryContract
{
    public function getData($fileName = null): array
    {        
        $customerReadings = [];

        if (($open = fopen(storage_path() . "/files/{$fileName}", "r")) !== FALSE) {

            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                $customerReadings[] = $data;
            }

            fclose($open);
        }

        foreach ($customerReadings as $key => $element) {
            if ($key !== 0) {
                $customerReading = new CustomerReading();
                $customerReading->customerId = $element[0];
                $customerReading->period = $element[1];
                $customerReading->month = Carbon::parse($customerReading->period)->month;
                $customerReading->reading = (int) $element[2];
                $data[] = $customerReading;
            }
        }

        return $data;
    }
}