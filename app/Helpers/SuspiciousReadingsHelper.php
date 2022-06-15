<?php

namespace App\Helpers;

class SuspiciousReadingsHelper
{
    /**
     * @param CustomerReading[] $customerReadings
     */
    public static function getReadingsAverage($customerReadings): int
    {
        $readingAverage = 0;
        foreach ($customerReadings as $customerReading) {
            $readingAverage += $customerReading->reading;
        }
        $readingAverage = $readingAverage / count($customerReadings);

        return $readingAverage;
    }

    /**
     * @param CustomerReading[] $customerReadings
     */
    public static function sortSuspiciousReadings(&$customerReadings)
    {
        $readingAverage = self::getReadingsAverage($customerReadings);
        $customerReadings = array_filter($customerReadings, function ($customerReading) use ($readingAverage) {
            return ($customerReading->reading > ($readingAverage * 1.5)) || ($customerReading->reading < ($readingAverage / 1.5)); //+- 50%
        });

        //SORT ASC BY MONTH
        usort($customerReadings, function ($a, $b) {
            return  $a->month > $b->month;
        });
    }
}
