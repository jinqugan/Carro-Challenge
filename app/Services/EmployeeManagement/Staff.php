<?php

namespace App\Services\EmployeeManagement;

use App\Interfaces\StaffInterface;

class Staff implements StaffInterface
{
    public function salary(): int
    {
        return 200;
    }
}
