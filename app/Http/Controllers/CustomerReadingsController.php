<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerReadingsController extends Controller
{
    public function readCustomerReadingsFile($fileName){
        $fileExtension = pathinfo(public_path($fileName), PATHINFO_EXTENSION);
        dd($fileExtension);
    }
    
}
