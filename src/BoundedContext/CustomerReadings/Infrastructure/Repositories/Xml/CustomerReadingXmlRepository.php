<?php 

namespace Src\BoundedContext\CustomerReadings\Infrastructure\Repositories\Xml;

use Carbon\Carbon;
use Src\BoundedContext\CustomerReadings\Domain\Contracts\CustomerReadingsRepositoryContract;
use Src\BoundedContext\CustomerReadings\Domain\CustomerReading;

class CustomerReadingXmlRepository implements CustomerReadingsRepositoryContract
{
    public function getData($fileName = null): array
    {        
        $xmlObject = simplexml_load_file(storage_path() . "/files/{$fileName}");
        // dd((string)$xmlObject->reading[2]["clientID"]);
        foreach ($xmlObject as $element) {
            $customerReading = new CustomerReading();
            $customerReading->customerId = (string) $element['clientID'];
            $customerReading->period = (string) $element['period'];
            $customerReading->month = Carbon::parse($customerReading->period)->month;
            $customerReading->reading = (int) $element;
            $data[] = $customerReading;
        }

        return $data;
    }
}