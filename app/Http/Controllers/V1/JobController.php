<?php

namespace App\Http\Controllers\V1;

use App\Services\EmployeeManagement\Applicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    protected $applicant;

    public function __construct(Applicant $applicant)
    {
        $this->applicant = $applicant;
    }

    public function apply(Request $request)
    {
        return response()->json([
            'data' => $this->applicant->applyJob(),
        ]);
    }
}
