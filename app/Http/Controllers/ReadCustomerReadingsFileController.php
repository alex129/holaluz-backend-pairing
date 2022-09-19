<?php

namespace App\Http\Controllers;

use App\Enums\FileTypes;
use App\Repositories\CustomerReadingsRepo;
use Exception;
use Illuminate\Http\Request;

class ReadCustomerReadingsFileController
{
    protected $customerReadingsRepo;

    public function __construct(CustomerReadingsRepo $customerReadingsRepo)
    {
        $this->customerReadingsRepo = $customerReadingsRepo;
    }

    public function __invoke($fileName)
    {
        $fileExtension = pathinfo(public_path($fileName), PATHINFO_EXTENSION);

        switch (strtoupper($fileExtension)) {
            case FileTypes::XML->name:
                return $this->customerReadingsRepo->getDataFromXML($fileName);
            case FileTypes::CSV->name:
                return $this->customerReadingsRepo->getDataFromCSV($fileName);
        }

        throw new Exception("File extension not suported");
    }
}
