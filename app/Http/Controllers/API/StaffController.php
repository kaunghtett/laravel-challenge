<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiController;
use App\Services\EmployeeManagement\Employee;
// use App\Services\EmployeeManagement\Staff;
use Illuminate\Http\Request;

class StaffController extends ApiController
{
    protected $employee;
    
    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }
    
    public function payroll()
    {
        $data = $this->employee->salary();
    
        return response()->json([
            'data' => $data
        ]);
    }
}
