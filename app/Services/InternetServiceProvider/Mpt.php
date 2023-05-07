<?php

namespace App\Services\InternetServiceProvider;

use App\Interfaces\CalculatorInterface;

class Mpt implements CalculatorInterface
{
    protected $operator = 'mpt';
    protected $monthlyFees = 200;

    public function calculate(?int $month): float
    {
        return ($month ?? 1) * $this->monthlyFees;
    }
}
