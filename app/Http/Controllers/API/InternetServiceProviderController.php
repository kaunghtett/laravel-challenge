<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Api\ApiController;
use App\Services\InternetServiceProvider\Mpt;
use App\Services\InternetServiceProvider\Ooredoo;
use Illuminate\Http\Request;

class InternetServiceProviderController extends ApiController
{
    public function getMptInvoiceAmount(Request $request)
    {
        $amount = $this->InvoiceAmount(new Mpt(), $request->get('month'));
       
        return $this->respondSuccessData($amount);
    }
    
    public function getOoredooInvoiceAmount(Request $request)
    {
        $amount = $this->InvoiceAmount(new Ooredoo(), $request->get('month'));
        return $this->respondSuccessData($amount);
    }

    public static function InvoiceAmount($service, $month = 1) {
        $service->setMonth($month);
        $amount = $service->calculateTotalAmount();
        return $amount;
    }
}
