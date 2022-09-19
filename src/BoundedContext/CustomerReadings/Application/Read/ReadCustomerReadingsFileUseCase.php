<?php 

namespace Src\BoundedContext\CustomerReadings\Application\Read;

use Src\BoundedContext\CustomerReadings\Domain\Contracts\CustomerReadingsRepositoryContract;

class ReadCustomerReadingsFileUseCase 
{
    protected $customerReadingsRepository;

    public function __construct(CustomerReadingsRepositoryContract $customerReadingsRepository)
    {
        $this->customerReadingsRepository = $customerReadingsRepository;
    }


    public function __invoke($fileName = null) :array
    {
        return $this->customerReadingsRepository->getData($fileName);
    }
}