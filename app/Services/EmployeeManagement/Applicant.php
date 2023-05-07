<?php

namespace App\Services\EmployeeManagement;

use App\Interfaces\EmployeeInterface;

class Applicant implements EmployeeInterface
{
    public function applyJob(): bool
    {
        return true;
    }
}
