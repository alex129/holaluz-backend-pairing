<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommandLineTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_read_readings_wrong_extension()
    {
        $this->artisan('read:readings hola.pdf')
            ->expectsOutput('File extension not suported')
            ->assertExitCode(0);
    }

    public function test_read_readings()
    {
        $this->artisan('read:readings 2016-readings.xml')
            ->assertExitCode(0);
    }
}
