<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiController;
// use App\Services\EmployeeManagement\Applicant;
use App\Services\EmployeeManagement\Employee;
use Illuminate\Http\Request;

class JobController extends ApiController
{
    protected $employee;
    
    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }
    
    public function apply(Request $request)
    {
        $data = $this->employee->applyJob();
        
        return response()->json([
            'data' => $data
        ]);
    }
}
