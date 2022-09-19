<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Src\BoundedContext\Shared\Infrastructure\Console\Commands\checkCustomerReadings;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        checkCustomerReadings::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
       // $this->load(__DIR__.'/Commands');
        $this->load(__DIR__.'/../Src/BoundedContext/Shared/Infrastructure/Console/Commands');

        require base_path('routes/console.php');
    }
}
