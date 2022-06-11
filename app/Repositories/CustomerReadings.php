<?php 

namespace App\Repositories;

use App\Models\CustomerReading;

interface CustomerReadings{
    /**
     * @return CustomerReading[]
     */
    public function getData(): Iterable;
}