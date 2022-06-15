<?php 

namespace App\Repositories;

use App\Models\CustomerReading;

interface CustomerReadings{
    /**
     * @return CustomerReading[]
     */
    public function getDataFromXML($fileName): Iterable;
    /**
     * @return CustomerReading[]
     */
    public function getDataFromCSV($fileName): Iterable;
    /**
     * @return CustomerReading[]
     */
    public function getDataFromTXT($fileName): Iterable;
    /**
     * @return CustomerReading[]
     */
    public function getDataFromDB($model): Iterable;
    /**
     * @return CustomerReading[]
     */
    public function getDataFromFTP($connection, $fileName): Iterable;
}