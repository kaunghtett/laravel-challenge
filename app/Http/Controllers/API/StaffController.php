<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiController;
use App\Services\EmployeeManagement\Staff;
use Illuminate\Http\Request;

class StaffController extends ApiController
{
    protected $staff;
    
    public function __construct(Staff $staff)
    {
        $this->staff = $staff;
    }
    
    public function payroll()
    {
        $data = $this->staff->salary();
    
        return response()->json([
            'data' => $data
        ]);
    }
}
