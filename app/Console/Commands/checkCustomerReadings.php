<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class checkCustomerReadings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'read:readings {file_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Customer suspicious readings ';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $headers = ['Name', 'Awesomeness Level'];
        $data = [
            ['Jim', 'Meh'],
            ['Conchita', 'Fabulous']
        ];


        $this->table($headers, $data);
    }
}
