<?php 

namespace Src\BoundedContext\CustomerReadings\Domain\Contracts;

interface CustomerReadingsRepositoryContract {
    public function getData($fileName = null) :array;
}