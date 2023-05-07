<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\EmployeeManagement\Staff;

class StaffController extends Controller
{
    protected $staff;

    public function __construct(Staff $staff)
    {
        $this->staff = $staff;
    }

    public function payroll()
    {
        return response()->json([
            'data' => $this->staff->salary(),
        ]);
    }
}
