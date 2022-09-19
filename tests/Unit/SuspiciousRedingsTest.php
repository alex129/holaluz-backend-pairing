<?php

namespace Tests\Unit;

use App\Helpers\SuspiciousReadingsHelper;
use App\Models\CustomerReading;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SuspiciousRedingsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_average_customer_readings()
    {
        $customerReadings = null;
        for($i = 0;$i < 10;$i++){
            $customerReading = new CustomerReading();
            $customerReading->customerId = "123456";
            $customerReading->period = "2016-01";
            $customerReading->month = 1;
            $customerReading->reading = 5000;
            $customerReadings[] = $customerReading;
        }

        $result = SuspiciousReadingsHelper::getReadingsAverage($customerReadings);
        $this->assertEquals($result, 5000);
    }
}
