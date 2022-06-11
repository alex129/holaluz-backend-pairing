<?php

namespace App\Console\Commands;

use App\Http\Controllers\CustomerReadingsController;
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
    protected $description = 'Customer suspicious readings';

    protected $customerReadingsController;

    public function __construct(CustomerReadingsController $customerReadingsController)
    {
        parent::__construct();
        $this->customerReadingsController = $customerReadingsController;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->customerReadingsController->readCustomerReadingsFile($this->argument('file_name'));
        $headers = ['Name', 'Awesomeness Level'];
        $data = [
            ['Jim', 'Meh'],
            ['Conchita', 'Fabulous']
        ];


        $this->table($headers, $data);
    }
}
