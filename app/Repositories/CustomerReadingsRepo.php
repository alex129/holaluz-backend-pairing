<?php

namespace App\Repositories;

use App\Models\CustomerReading;
use Carbon\Carbon;
use DOMDocument;
use Exception;
use Ramsey\Uuid\Type\Decimal;
use XMLReader;

class CustomerReadingsRepo
{
    /**
     * @param String $fileName
     * @return CustomerReading[]
     */
    public function getDataFromXML($fileName): array
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

    /**
     * @param String $fileName
     * @return CustomerReading[]
     */
    public function getDataFromCSV($fileName): array
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

    public function getDataFromTXT($fileName): iterable
    {
        return [];
    }

    public function getDataFromDB($model): iterable
    {
        return [];
    }

    public function getDataFromFTP($connection, $fileName): iterable
    {
        return [];
    }
}
