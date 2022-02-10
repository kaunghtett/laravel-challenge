<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiController;
use App\Services\EmployeeManagement\Applicant;
use Illuminate\Http\Request;

class JobController extends ApiController
{
    protected $applicant;
    
    public function __construct(Applicant $applicant)
    {
        $this->applicant = $applicant;
    }
    
    public function apply(Request $request)
    {
        $data = $this->applicant->applyJob();
        
        return response()->json([
            'data' => $data
        ]);
    }
}
