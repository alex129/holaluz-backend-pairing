<?php

namespace App\Repositories;

use App\Models\CustomerReading;
use Carbon\Carbon;
use DOMDocument;
use Ramsey\Uuid\Type\Decimal;
use XMLReader;

class CustomerReadingsRepo implements CustomerReadings
{
    public function getDataFromXML($fileName): iterable
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

        $this->sortSuspiciousReadings($data);

        return $data;
    }

    public function getDataFromCSV($fileName): iterable
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

        $this->sortSuspiciousReadings($data);

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

    public function getReadingsAverage($customerReadings): int
    {
        $readingAverage = 0;
        foreach ($customerReadings as $customerReading) {
            $readingAverage += $customerReading->reading;
        }
        $readingAverage = $readingAverage / count($customerReadings);

        return $readingAverage;
    }

    private function sortSuspiciousReadings(&$customerReadings)
    {
        $readingAverage = $this->getReadingsAverage($customerReadings);
        $customerReadings = array_filter($customerReadings, function ($customerReading) use ($readingAverage) {
            return ($customerReading->reading > ($readingAverage * 1.5)) || ($customerReading->reading < ($readingAverage / 1.5)); //+- 50%
        });

        //SORT ASC BY MONTH
        usort($customerReadings, function ($a, $b) {
            return  $a->month > $b->month;
        });
    }
}
