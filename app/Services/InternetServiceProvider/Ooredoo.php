<?php

namespace App\Services\InternetServiceProvider;

use App\Interfaces\CalculatorInterface;

class Ooredoo implements CalculatorInterface
{
    protected $operator = 'ooredoo';
    protected $monthlyFees = 150;

    public function calculate(?int $month): float
    {
        return ($month ?? 1) * $this->monthlyFees;
    }
}
