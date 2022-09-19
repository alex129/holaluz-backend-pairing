<?php

namespace Tests\Feature\Unit;

use App\Http\Controllers\ReadCustomerReadingsFileController;
use App\Repositories\CustomerReadingsRepo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class CustomerReadingsControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_read_customer_readings_file_xml()
    {
        $mock = $this->mock(CustomerReadingsRepo::class, function (MockInterface $mock) {
            $mock->shouldReceive('getDataFromXML')->once();
        });
        $controller = new ReadCustomerReadingsFileController($mock);
        $controller("file.xml");
    }

    public function test_read_customer_readings_file_csv()
    {
        $mock = $this->mock(CustomerReadingsRepo::class, function (MockInterface $mock) {
            $mock->shouldReceive('getDataFromCSV')->once();
        });
        $controller = new ReadCustomerReadingsFileController($mock);
        $controller("file.csv");
    }
}
