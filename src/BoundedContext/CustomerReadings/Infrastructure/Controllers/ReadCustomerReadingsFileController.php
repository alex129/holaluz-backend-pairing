<?php

namespace Src\BoundedContext\CustomerReadings\Infrastructure\Controllers;

use Src\BoundedContext\Shared\Domain\Enums\FileTypes;
use App\Repositories\CustomerReadingsRepo;
use Exception;
use Illuminate\Http\Request;
use Src\BoundedContext\CustomerReadings\Application\Read\ReadCustomerReadingsFileUseCase;
use Src\BoundedContext\CustomerReadings\Infrastructure\Repositories\Csv\CustomerReadingCsvRepository;
use Src\BoundedContext\CustomerReadings\Infrastructure\Repositories\Xml\CustomerReadingXmlRepository;

class ReadCustomerReadingsFileController
{
    public function __invoke($fileName)
    {
        $fileExtension = pathinfo(public_path($fileName), PATHINFO_EXTENSION);

        switch (strtoupper($fileExtension)) {
            case FileTypes::XML->name:                
                $readReadingsUseCase = new ReadCustomerReadingsFileUseCase(new CustomerReadingXmlRepository());
                return $readReadingsUseCase($fileName);
            case FileTypes::CSV->name:
                $readReadingsUseCase = new ReadCustomerReadingsFileUseCase(new CustomerReadingCsvRepository());
                return $readReadingsUseCase($fileName);
        }

        throw new Exception("File extension not suported");
    }
}
